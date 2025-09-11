<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginFormType;
use App\Form\RegistrationFormType;
use App\Form\ForgotPasswordType;
use App\Service\MailService;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\FormError;

class AuthController extends AbstractController
{
    /**
     * Page de connexion
     */
    #[Route('/auth/login', name: 'auth.login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $form = $this->createForm(LoginFormType::class);

        return $this->render('auth/login.html.twig', [
            'form' => $form->createView(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername(),
        ]);
    }

    /**
     * Page d'inscription + envoi d'email de bienvenue
     */
    #[Route('/auth/register', name: 'auth.register', methods: ['GET', 'POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $em,
        MailService $mailService
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            $confirmPassword = $form->get('confirmPassword')->getData();

            if ($plainPassword !== $confirmPassword) {
                $form->addError(new FormError('Les mots de passe ne correspondent pas.'));
            } else {
                $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
                $user->setRoles(['ROLE_USER']);

                $em->persist($user);
                $em->flush();

                $mailService->sendAccountConfirmation($user->getEmail(), $user->getUsername());

                $this->addFlash('success', 'Inscription réussie');
                return $this->redirectToRoute('auth.login');
            }
        }

        return $this->render('auth/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Page de demande de réinitialisation de mot de passe + envoi d'email
     */
    #[Route('/auth/forgot_password', name: 'auth.forgot_password', methods: ['GET', 'POST'])]
    public function forgotPassword(
        Request $request,
        EntityManagerInterface $em,
        MailService $mailService
    ): Response {
        $form = $this->createForm(ForgotPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $user = $em->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user) {
                $token = bin2hex(random_bytes(32));
                $user->setResetToken($token);
                $user->setTokenExpiresAt(new \DateTime('+1 hour'));

                $em->flush();

                $resetLink = $this->generateUrl('auth.password_reset', [
                    'token' => $token,
                ], UrlGeneratorInterface::ABSOLUTE_URL);

                $mailService->sendPasswordReset($user->getEmail(), $resetLink);
            }

            $this->addFlash('success', "Si l'adresse existe, un lien de réinitialisation vous a été envoyé.");
        }

        return $this->render('auth/forgot_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Page de réinitialisation du mot de passe via lien sécurisé
     */
    #[Route('/auth/reset-password/{token}', name: 'auth.password_reset', methods: ['GET', 'POST'])]
    public function resetPassword(
        string $token,
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $user = $em->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user || $user->getTokenExpiresAt() < new \DateTime()) {
            $this->addFlash('error', 'Lien invalide ou expiré.');
            return $this->redirectToRoute('auth.forgot_password');
        }

        if ($request->isMethod('POST')) {
            $newPassword = $request->request->get('newPassword');
            $confirmPassword = $request->request->get('confirmPassword');

            if ($newPassword !== $confirmPassword) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
            } elseif (strlen($newPassword) < 6) {
                $this->addFlash('error', 'Le mot de passe doit contenir au moins 6 caractères.');
            } else {
                $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($hashedPassword);
                $user->setResetToken(null);
                $user->setTokenExpiresAt(null);

                $em->flush();

                $this->addFlash('success', 'Ton mot de passe a été mis à jour.');
                return $this->redirectToRoute('auth.login');
            }
        }

        return $this->render('auth/reset_password.html.twig', [
            'token' => $token,
            'user' => $user,
        ]);
    }

    /**
     * Méthode interceptée par le firewall pour la déconnexion
     */
    #[Route('/auth/logout', name: 'auth.logout')]
    public function logout(): void
    {
        throw new \LogicException('Cette méthode peut rester vide — elle est interceptée par le firewall.');
    }

    /**
     * Page affichée après déconnexion
     */
    #[Route('/auth/logged-out', name: 'auth.logged_out')]
    public function loggedOut(): Response
    {
        return $this->render('auth/logout.html.twig');
    }

    /**
 * Activation d’un compte administrateur via lien sécurisé
 */
    #[Route('/auth/activate/{token}', name: 'auth.activate', methods:  ['GET', 'POST'])]
    public function activateAccount(
    string $token,
    Request $request,
    EntityManagerInterface $em,
    UserPasswordHasherInterface $passwordHasher
    ): Response {
        $user = $em->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user || $user->getTokenExpiresAt() < new \DateTime()) {
            $this->addFlash('error', 'Lien invalide ou expiré.');
            return $this->redirectToRoute('auth.login');
    }

        if ($request->isMethod('POST')) {
            $newPassword = $request->request->get('newPassword');
            $confirmPassword = $request->request->get('confirmPassword');

            if ($newPassword !== $confirmPassword) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
            } elseif (strlen($newPassword) < 6) {
                $this->addFlash('error', 'Le mot de passe doit contenir au moins 6 caractères.');
            } else {
                $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($hashedPassword);
                $user->setResetToken(null);
                $user->setTokenExpiresAt(null);

                $em->flush();

                $this->addFlash('success', 'Votre compte est activé. Vous pouvez maintenant vous connecter.');
                return $this->redirectToRoute('auth.login');
            }
    }

    return $this->render('auth/activate.html.twig', [
        'token' => $token,
        'user' => $user,
    ]);
}
}