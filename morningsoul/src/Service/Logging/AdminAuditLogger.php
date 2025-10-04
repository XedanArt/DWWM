<?php

namespace App\Service\Logging;

use App\Entity\User;
use Psr\Log\LoggerInterface;

class AdminAuditLogger
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $superAdminLogger)
    {
        $this->logger = $superAdminLogger;
    }

    public function logAdminCreation(User $admin): bool
    {
        $this->logger->info("Administrateur créé : " . $admin->getEmail());
        
        return true;
    }

    public function logAdminRevoked(User $admin): void
    {
        $this->logger->warning("Administrateur révoqué : " . $admin->getEmail());
    }

    public function logAdminInvitationSent(User $admin): void
    {
        $this->logger->notice("Invitation envoyée à l’administrateur : " . $admin->getEmail());
    }

    public function logDuplicateEmailAttempt(string $email): void
    {
        $this->logger->warning("Tentative de création avec email déjà existant : $email");
    }

    public function logRevocationError(User $admin): void
    {
        $this->logger->error("Tentative de révocation de soi-même par : " . $admin->getEmail());
    }

    public function logNonAdminRevocationAttempt(User $user): void
    {
        $this->logger->notice("Tentative de révocation sur un compte non-admin : " . $user->getEmail());
    }
}