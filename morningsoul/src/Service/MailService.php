<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Psr\Log\LoggerInterface;

class MailService
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig,
        private LoggerInterface $logger // injecté via autowire
    ) {}

    public function sendAccountConfirmation(string $to, string $username): void
    {
        try {
            $html = $this->twig->render('emails/account_confirmation.html.twig', [
                'username' => $username,
            ]);

            $email = (new Email())
                ->from('contact@morningsoul.fr')
                ->to($to)
                ->subject('Bienvenue sur Morning Soul !')
                ->html($html);

            $this->mailer->send($email);
        } catch (\Throwable $e) {
            $this->logger->error('Erreur envoi mail de confirmation', [
                'to' => $to,
                'username' => $username,
                'exception' => $e->getMessage(),
            ]);
        }
    }

    public function sendPasswordReset(string $to, string $resetLink): void
    {
        try {
            $html = $this->twig->render('emails/password_reset.html.twig', [
                'resetLink' => $resetLink,
            ]);

            $email = (new Email())
                ->from('contact@morningsoul.fr')
                ->to($to)
                ->subject('Réinitialisation de ton mot de passe')
                ->html($html);

            $this->mailer->send($email);
        } catch (\Throwable $e) {
            $this->logger->error('Erreur envoi mail de réinitialisation', [
                'to' => $to,
                'resetLink' => $resetLink,
                'exception' => $e->getMessage(),
            ]);
        }
    }
}