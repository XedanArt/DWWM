<?php

namespace App\Controller;

use DateTime;
use App\Form\ContactType;
use App\Repository\PresentationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomepageController extends AbstractController 
{
    // [URL + NOM DE LA ROUTE, index = accueil)]
    #[Route('/', name: 'homepage.index')]
    public function index(): Response {
       $title = "Morning Soul - Jeu Indépendant";
       $subtitle = "- Un espace communautaire pour suivre l’évolution du projet -";
       return $this->render('homepage/index.html.twig', [
        "title" => $title, 
        "subtitle" => $subtitle]);
    }

    // game > discover
    #[Route('/game/discover', name: 'game.discover')]
    public function discover(
        PresentationRepository $presentation_repository
    ): Response {
        $contenu = $presentation_repository -> findAll();
        return $this->render('game/discover.html.twig', ["contenu" => $contenu]);
    }

    // game > download
    #[Route('/game/download', name: 'game.download')]
    public function download(
        Request $request,
        // Canal personnalisé de logs, téléchargement côté client -> checker pour une solution
        #[Autowire(service: 'monolog.logger.download')] LoggerInterface $logger
    ): Response {
        /** @var \App\Entity\User|null $user */

        $user = $this->getUser();

        $logger->info('Téléchargement déclenché', [
            // Si pas de $user alors ?? -> anonymous
            'userId'    => $user?->getId() ?? 'anonymous',
            'username'  => $user?->getUsername() ?? 'anonymous',
            // Transmise à getClientIp via $request
            'ip' => $request->getClientIp(),
            'userAgent' => $request->headers->get('User-Agent'),
            'timestamp' => (new \DateTimeImmutable())->format('c'),
        ]);

        return $this->render('game/download.html.twig');
    }




    // Le formulaire de contact renvoi une vue classique ou une vue 'success' si envoi de formulaire réussi
    #[Route('/contact/support', name: 'contact.support')]
    public function support(
        Request $request,
        MailerInterface $mailer,
        // Canal personnalisé de logs, monolog.yaml
        #[Autowire(service: 'monolog.logger.contact_form')]
        LoggerInterface $logger
    ): Response {
        // Création du formulaire
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        // Si les contraintes sont respectées
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var array $data */
            // Récupération des données
            $data = $form->getData();

            // Construction de l'email Brevo
            $email = (new Email())
                ->from('contact@morningsoul.fr')
                ->replyTo($data['email'])
                ->to('contact@morningsoul.fr')
                ->subject('Demande de support')
                ->text($data['message'])
                ->html('<p><strong>Nom :</strong> ' . htmlspecialchars($data['nom']) . '<br>' .
                '<strong>Email :</strong> ' . htmlspecialchars($data['email']) . '<br>' .
                '<strong>Message :</strong><br>' . nl2br(htmlspecialchars($data['message'])) . '</p>');

            try {// Envoi via Brevo, config mailer.yaml
                $mailer->send($email);

                // Log de soumission réussie
                $logger->info('Formulaire de contact soumis avec succès.', [
                    'nom' => $data['nom'],
                    'email' => $data['email'],
                    'message' => $data['message'],
                    'ip' => $request->getClientIp(),
                    'userAgent' => $request->headers->get('User-Agent'),
                ]);

                $this->addFlash('success', 'Votre message a bien été envoyé. Nous vous répondrons sous peu.');
            } catch (\Throwable $e) {
                $logger->error('Erreur SMTP : ' . $e->getMessage());
                $logger->error('Erreur SMTP lors de l’envoi du formulaire de contact.', [
                    'nom' => $data['nom'],
                    'email' => $data['email'],
                    'message' => $data['message'],
                    'exception' => $e->getMessage(),
                    'ip' => $request->getClientIp(),
                    'userAgent' => $request->headers->get('User-Agent'),
                ]);

                $this->addFlash('danger', 'Le serveur de mail ne répond pas. Réessayez plus tard.');
            }

            return $this->redirectToRoute('contact.support');
        }

        if ($form->isSubmitted()) {
            $logger->warning('Formulaire de contact soumis invalide.', [
                'erreurs' => (string) $form->getErrors(true, false),
                'ip' => $request->getClientIp(),
                'userAgent' => $request->headers->get('User-Agent'),
            ]);
        }

    return $this->render('contact/support.html.twig', [
        'form' => $form->createView()
    ]);
}




    // contact > socials
    #[Route('/contact/socials', name: 'contact.socials')]
    public function socials(): Response {
        return $this->render('contact/socials.html.twig');
    }
} 

