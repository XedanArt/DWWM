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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class AuthController extends AbstractController
{
    #[Route('/auth/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage.index');
        }

        $form = $this->createForm(LoginFormType::class);

        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('auth/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }

    #[Route('/auth/register', name: 'auth.register', methods: ['GET', 'POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $em,
        MailService $mailService
    ): Response {
        if ($this->getUser()) {
            return $this->redirectToRoute('account.profile');
        }

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
                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('auth/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/auth/forgot_password', name: 'auth.forgot_password', methods: ['GET', 'POST'])]
    public function forgotPassword(
        Request $request,
        EntityManagerInterface $em,
        MailService $mailService
    ): Response {
        if ($this->getUser()) {
            return $this->render('auth/already_logged_in.html.twig');
        }

        $form = $this->createForm(ForgotPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $user = $em->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user) {
                $now = new \DateTime();
                $lastRequest = $user->getLastPasswordRequestAt();

                if ($lastRequest && $now->getTimestamp() - $lastRequest->getTimestamp() < 600) {
                    $this->addFlash('error', 'Une demande a déjà été faite récemment. Veuillez patienter quelques minutes.');
                    return $this->redirectToRoute('auth.forgot_password');
                }

                $token = bin2hex(random_bytes(32));
                $user->setResetToken($token);
                $user->setTokenExpiresAt(new \DateTime('+1 hour'));
                $user->setLastPasswordRequestAt($now);

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

    #[Route('/auth/reset-password/{token}', name: 'auth.password_reset', methods: ['GET', 'POST'])]
    public function resetPassword(
        string $token,
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        if ($this->getUser()) {
            return $this->render('auth/already_logged_in.html.twig');
        }

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
            } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,64}$/', $newPassword)) {
                $this->addFlash('error', 'Le mot de passe doit contenir entre 8 et 64 caractères, avec une majuscule, une minuscule, un chiffre et un caractère spécial.');
            } else {
                $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($hashedPassword);
                $user->setResetToken(null);
                $user->setTokenExpiresAt(null);

                $em->flush();

                $this->addFlash('success', 'Ton mot de passe a été mis à jour.');
                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('auth/reset_password.html.twig', [
            'token' => $token,
            'user' => $user,
        ]);
    }

    #[Route('/auth/logout', name: 'auth.logout')]
    public function logout(): void
    {
        throw new \LogicException('Cette méthode peut rester vide — elle est interceptée par le firewall.');
    }

    #[Route('/auth/logged-out', name: 'auth.logged_out')]
    public function loggedOut(): Response
    {
        return $this->render('auth/logout.html.twig');
    }

    #[Route('/auth/activate/{token}', name: 'auth.activate', methods: ['GET', 'POST'])]
    public function activateAccount(
        string $token,
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        if ($this->getUser()) {
            return $this->render('auth/already_logged_in.html.twig');
        }

        $user = $em->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user || $user->getTokenExpiresAt() < new \DateTime()) {
            $this->addFlash('error', 'Lien invalide ou expiré.');
            return $this->redirectToRoute('app_login');
        }

        if ($request->isMethod('POST')) {
            $newPassword = $request->request->get('newPassword');
            $confirmPassword = $request->request->get('confirmPassword');

            if ($newPassword !== $confirmPassword) {
                $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
            } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,64}$/', $newPassword)) {
                $this->addFlash('error', 'Le mot de passe doit contenir entre 8 et 64 caractères, avec une majuscule, une minuscule, un chiffre et un caractère spécial.');
            } else {
                $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($hashedPassword);
                $user->setResetToken(null);
                $user->setTokenExpiresAt(null);

                $em->flush();

                $this->addFlash('success', 'Votre compte est activé. Vous pouvez maintenant vous connecter.');
                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('auth/activate.html.twig', [
            'token' => $token,
            'user' => $user,
        ]);
    }
}