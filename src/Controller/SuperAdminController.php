<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminCreationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Uid\Uuid;
use App\Service\Logging\AdminAuditLogger;

// Controller restreint aux utilisateurs ayant le rôle ROLE_SUPER_ADMIN
// Toutes les routes commenceront par /superadmin
#[IsGranted('ROLE_SUPER_ADMIN')]
#[Route('/superadmin')]
class SuperAdminController extends AbstractController
{   
    // Vue + formulaire de création d'un administrateur = AdminCreationType
    #[Route('/create-admin', name: 'superadmin.create_admin')]
    public function showCreateAdminForm(Request $request): Response
    {
        $form = $this->createForm(AdminCreationType::class);

        return $this->render('superadmin/create_admin.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Soumission du formulaire de création admin + sécurisation de la création (email, mdp, token, log, flash, error)
    #[Route('/create-admin/submit', name: 'superadmin.create_admin.submit', methods: ['POST'])]
    public function handleCreateAdmin(
        Request $request,
        EntityManagerInterface $em,
        MailerInterface $mailer,
        UserPasswordHasherInterface $hasher,
        AdminAuditLogger $auditLogger
    ): Response {
        $user = new User();
        $form = $this->createForm(AdminCreationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $existingUser = $em->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
            if ($existingUser) {
                $this->addFlash('danger', 'Un compte avec cet email existe déjà.');
                $auditLogger->logDuplicateEmailAttempt($user->getEmail());
                return $this->redirectToRoute('superadmin.create_admin');
            }

            $user->setRoles(['ROLE_ADMIN']);

            $plainPassword = $form->get('plainPassword')->getData();
            $hashedPassword = $hasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            $token = Uuid::v4()->toRfc4122();
            $user->setResetToken($token);
            $user->setTokenExpiresAt((new \DateTime())->modify('+24 hours'));

            $em->persist($user);
            $em->flush();

            $activationLink = $this->generateUrl('auth.activate', [
                'token' => $token
            ], UrlGeneratorInterface::ABSOLUTE_URL);

            $email = (new TemplatedEmail())
                ->from('Morning Soul <no-reply@morning-soul.fr>')
                ->to($user->getEmail())
                ->subject('Activation de votre compte administrateur')
                ->htmlTemplate('emails/admin_invitation.html.twig')
                ->context([
                    'username' => $user->getUsername(),
                    'activationLink' => $activationLink
                ]);

            $mailer->send($email);

            $auditLogger->logAdminCreation($user);
            $auditLogger->logAdminInvitationSent($user);

            $this->addFlash('success', 'Invitation envoyée à l’administrateur.');
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('superadmin/create_admin.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Récupère les users en base, filtre le ROLE_ADMIN => vue
    #[Route('/revoke-admin', name: 'superadmin.revoke_admin')]
    public function showRevokeAdminForm(EntityManagerInterface $em): Response
    {
        $allUsers = $em->getRepository(User::class)->findAll();
        $admins = array_filter($allUsers, fn(User $user) => $user->isAdmin());

        return $this->render('superadmin/revoke_admin.html.twig', [
            'admins' => $admins
        ]);
    }

    // Révoque un admin + sécurité + log
    #[Route('/revoke-admin/submit/{id}', name: 'superadmin.revoke_admin.submit', methods: ['POST'])]
    public function handleRevokeAdmin(
        User $user,
        EntityManagerInterface $em,
        AdminAuditLogger $auditLogger
    ): Response {
        if ($user === $this->getUser()) {
            $this->addFlash('danger', 'Impossible de révoquer votre propre accès.');
            $auditLogger->logRevocationError($user);
            return $this->redirectToRoute('dashboard');
        }

        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            $user->setRoles(['ROLE_USER']);
            $em->flush();
            $this->addFlash('success', 'Administrateur révoqué.');
            $auditLogger->logAdminRevoked($user);
        } else {
            $this->addFlash('warning', 'Ce compte n’est pas un administrateur.');
            $auditLogger->logNonAdminRevocationAttempt($user);
        }

        return $this->redirectToRoute('superadmin.revoke_admin');
    }

    // Supprime un utilisateur de la base + sécurité + redirection vers dashboard
    #[Route('/delete-user/{id}', name: 'superadmin.delete_user', methods: ['POST'])]
    public function deleteUser(
        User $user,
        EntityManagerInterface $em,
        AdminAuditLogger $auditLogger
    ): Response {
        if ($user === $this->getUser()) {
            $this->addFlash('danger', 'Vous ne pouvez pas supprimer votre propre compte.');
        } else {
            $em->remove($user);
            $em->flush();
            $this->addFlash('success', 'Utilisateur supprimé.');
            $auditLogger->logAdminRevoked($user);
        }

        return $this->redirectToRoute('dashboard');
    }
}