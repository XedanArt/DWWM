<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailService
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig
    ) {}

    /**
     * Envoie un email de bienvenue après la création du compte
     */
    public function sendAccountConfirmation(string $to, string $username): void
    {
        $html = $this->twig->render('emails/account_confirmation.html.twig', [
            'username' => $username,
        ]);

        $email = (new Email())
            ->from('vincentpeltier.pro@outlook.fr')
            ->to($to)
            ->subject('Bienvenue sur Morning Soul !')
            ->html($html);

        $this->mailer->send($email);
    }

    /**
     * Envoie un email contenant le lien de réinitialisation du mot de passe
     */
    public function sendPasswordReset(string $to, string $resetLink): void
    {
        $html = $this->twig->render('emails/password_reset.html.twig', [
            'resetLink' => $resetLink,
        ]);

        $email = (new Email())
            ->from('vincentpeltier.pro@outlook.fr')
            ->to($to)
            ->subject('Réinitialisation de ton mot de passe')
            ->html($html);

        $this->mailer->send($email);
    }
}