<?php

namespace App\Service\Logging;

use Psr\Log\LoggerInterface;

class SecurityAuditLogger
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $securityLogger)
    {
        $this->logger = $securityLogger;
    }

    public function logLoginAttempt(string $email, bool $success): void
    {
        $message = $success
            ? "Connexion réussie pour $email"
            : "Échec de connexion pour $email";
        $this->logger->notice($message);
    }

    public function logAccessDenied(string $route, string $userEmail): void
    {
        $this->logger->warning("Accès refusé à $route pour $userEmail");
    }

    public function logCsrfViolation(string $route): void
    {
        $this->logger->error("Violation CSRF détectée sur la route : $route");
    }

    public function logAccountLocked(string $email): void
    {
        $this->logger->alert("Compte verrouillé pour $email");
    }
}