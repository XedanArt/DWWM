<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

// Authenticator personnalisé pour gérer la connexion via formulaire
class LoginAuthenticator extends AbstractLoginFormAuthenticator
{
    // Route du formulaire de login
    public const LOGIN_ROUTE = 'app_login';

    // Services injectés
    private EntityManagerInterface $entityManager;
    private UrlGeneratorInterface $urlGenerator;
    private UserPasswordHasherInterface $passwordHasher;

    // Constructeur : injection des dépendances
    public function __construct(
        EntityManagerInterface $entityManager,
        UrlGeneratorInterface $urlGenerator,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->passwordHasher = $passwordHasher;
    }

    // Vérifie si la requête est une tentative de login
    public function supports(Request $request): bool
    {
        return $request->attributes->get('_route') === self::LOGIN_ROUTE
            && $request->isMethod('POST');
    }

    // Authentifie l'utilisateur à partir des données du formulaire
    public function authenticate(Request $request): Passport
    {
        // Récupération des données du formulaire
        $formData = $request->request->all('login_form');
        $email = $formData['email'] ?? '';
        $password = $formData['password'] ?? '';
        $csrfToken = $formData['_csrf_token'] ?? '';

        // Recherche de l'utilisateur en base
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        // S'il n'existe pas -> exception personnalisée
        if (!$user) {
            throw new CustomUserMessageAuthenticationException('Adresse email inconnue.');
        }

        // Vérification du mot de passe
        if (!$this->passwordHasher->isPasswordValid($user, $password)) {
            throw new CustomUserMessageAuthenticationException('Mot de passe invalide.');
        }

        // Création du passport et des badges nécessaires
        return new Passport(
            new UserBadge($email, fn() => $user),
            new PasswordCredentials($password),
            [new CsrfTokenBadge('authenticate', $csrfToken)]
        );
    }

    // Action à effectuer après une authentification réussie
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): RedirectResponse
    {
        $user = $token->getUser();

        // Sécurité : vérifie que l'objet est bien un user
        if (!$user instanceof User) {
            // Échec silencieux → on redirige vers une page neutre ou on lève une exception
            throw new \LogicException('Utilisateur non reconnu après authentification.');
        }

        // Mise à jour de la date de dernière connexion
        $user->setLastLogin(new \DateTimeImmutable());
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Redirection selon le rôle
        if ($user->isSuperAdmin()) {
            return new RedirectResponse($this->urlGenerator->generate('dashboard'));
        }

        if ($user->isAdmin()) {
            return new RedirectResponse($this->urlGenerator->generate('dashboard'));
        }

        // Redirection par défaut utilisateurs classiques
        return new RedirectResponse($this->urlGenerator->generate('account.profile'));
    }

    // En cas d'échec, redirection sur le formulaire de login
    public function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}