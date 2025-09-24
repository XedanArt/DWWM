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

#[IsGranted('ROLE_SUPER_ADMIN')]
#[Route('/superadmin')]
class SuperAdminController extends AbstractController
{
    #[Route('/create-admin', name: 'superadmin.create_admin')]
    public function showCreateAdminForm(Request $request): Response
    {
        $form = $this->createForm(AdminCreationType::class);

        return $this->render('superadmin/create_admin.html.twig', [
            'form' => $form->createView()
        ]);
    }

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

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $existingUser = $em->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
                if ($existingUser) {
                    $this->addFlash('danger', 'Un compte avec cet email existe déjà.');
                    $auditLogger->logDuplicateEmailAttempt($user->getEmail());
                    return $this->redirectToRoute('superadmin.create_admin');
                }

                $user->setRoles(['ROLE_ADMIN']);

                $plainPassword = $form->get('plainPassword')->getData();
                dump($plainPassword);
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
            } else {
                foreach ($form->getErrors(true) as $error) {
                    $field = $error->getOrigin()->getName();
                    $message = $error->getMessage();
                    $this->addFlash('danger', "Erreur sur '$field' : $message");
                }
            }
        }

        return $this->render('superadmin/create_admin.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/revoke-admin', name: 'superadmin.revoke_admin')]
    public function showRevokeAdminForm(EntityManagerInterface $em): Response
    {
        $allUsers = $em->getRepository(User::class)->findAll();
        $admins = array_filter($allUsers, fn(User $user) => $user->isAdmin());

        return $this->render('superadmin/revoke_admin.html.twig', [
            'admins' => $admins
        ]);
    }

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

}