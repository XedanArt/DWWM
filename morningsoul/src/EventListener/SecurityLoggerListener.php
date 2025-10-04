<?php

namespace App\EventListener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Psr\Log\LoggerInterface;

class SecurityLoggerListener
{
    public function __construct(private LoggerInterface $securityLogger) {}

    public function onLoginSuccess(InteractiveLoginEvent $event): void
    {
        $user = $event->getAuthenticationToken()->getUser();
        $this->securityLogger->info("✅ Connexion réussie pour {$user->getUsername()}");
    }

    public function onLoginFailure(AuthenticationFailureEvent $event): void
    {
        $credentials = $event->getAuthenticationToken()->getCredentials();
        $this->securityLogger->warning("❌ Échec de connexion pour l'email : {$credentials['email']}");
    }

    public function onLogout(LogoutEvent $event): void
    {
        $user = $event->getToken()?->getUser();
        if ($user) {
            $this->securityLogger->info("🚪 Déconnexion de {$user->getUsername()}");
        }
    }
}