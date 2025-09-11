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
        UserPasswordHasherInterface $hasher
    ): Response {
        $user = new User();
        $form = $this->createForm(AdminCreationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_ADMIN']);

            // Hachage du mot de passe
            $plainPassword = $form->get('plainPassword')->getData();
            $hashedPassword = $hasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            // Génération du token d’activation
            $token = Uuid::v4()->toRfc4122();
            $user->setResetToken($token);
            $user->setTokenExpiresAt((new \DateTime())->modify('+24 hours'));

            $em->persist($user);
            $em->flush();

            // Envoi de l’email d’activation
            $activationLink = $this->generateUrl('auth.activate', [
                'token' => $token
            ], UrlGeneratorInterface::ABSOLUTE_URL);

            $email = (new TemplatedEmail())
                ->from('Morning Soul <no-reply@morning-soul.fr>') // ← Expéditeur ajouté ici
                ->to($user->getEmail())
                ->subject('Activation de votre compte administrateur')
                ->htmlTemplate('emails/admin_invitation.html.twig')
                ->context([
                'username' => $user->getUsername(),
                'activationLink' => $activationLink
            ]);

            $mailer->send($email);

            $this->addFlash('success', 'Invitation envoyée à l’administrateur.');
            return $this->redirectToRoute('dashboard');
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
    public function handleRevokeAdmin(User $user, EntityManagerInterface $em): Response
    {
        if ($user === $this->getUser()) {
            $this->addFlash('danger', 'Impossible de révoquer votre propre accès.');
            return $this->redirectToRoute('dashboard');
        }

        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            $user->setRoles(['ROLE_USER']);
            $em->flush();
            $this->addFlash('success', 'Administrateur révoqué.');
        } else {
            $this->addFlash('warning', 'Ce compte n’est pas un administrateur.');
        }

        return $this->redirectToRoute('superadmin.revoke_admin');
    }
}