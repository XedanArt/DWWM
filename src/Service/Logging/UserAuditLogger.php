<?php

namespace App\Service\Logging;

use App\Entity\User;
use Psr\Log\LoggerInterface;

class UserAuditLogger
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $userLogger)
    {
        $this->logger = $userLogger;
    }

    public function logUserCreated(User $user): void
    {
        $this->logger->info("Utilisateur créé : " . $user->getEmail());
    }

    public function logUserUpdated(User $user): void
    {
        $this->logger->notice("Profil mis à jour pour : " . $user->getEmail());
    }

    public function logUserDeleted(User $user): void
    {
        $this->logger->warning("Utilisateur supprimé : " . $user->getEmail());
    }

    public function logEmailChange(User $user, string $oldEmail, string $newEmail): void
    {
        $this->logger->info("Changement d’email pour {$user->getUsername()} : $oldEmail → $newEmail");
    }
}