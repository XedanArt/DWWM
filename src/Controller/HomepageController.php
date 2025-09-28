<?php

namespace App\Controller;

use DateTime;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PresentationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomepageController extends AbstractController 
{
    // [URL + NOM DE LA ROUTE, index = accueil)]
    #[Route('/', name: 'homepage.index')]
    public function index(): Response {
       $title = "Morging Soul - Jeu Indépendant";
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
        #[Autowire(service: 'monolog.logger.download')] LoggerInterface $logger
    ): Response {
        /** @var \App\Entity\User|null $user */


        $user = $this->getUser();

        $logger->info('Téléchargement déclenché', [
            'userId'    => $user?->getId() ?? 'anonymous',
            'username'  => $user?->getUsername() ?? 'anonymous',
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
        EntityManagerInterface $em,
        #[Autowire(service: 'monolog.logger.contact_form')]
        LoggerInterface $logger
    ): Response {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
        if ($form->isValid()) {
            $contact = $form->getData();
            $em->persist($contact);
            $em->flush();

            // Log de soumission réussie
            $logger->info('Formulaire de contact soumis avec succès.', [
                'nom' => $contact->getNom(),
                'email' => $contact->getEmail(),
                'message' => $contact->getMessage(),
                'ip' => $request->getClientIp(),
                'userAgent' => $request->headers->get('User-Agent'),
            ]);

            $this->addFlash('success', 'Votre message a bien été envoyé. Nous vous répondrons sous peu.');
            return $this->redirectToRoute('contact.support');
        } else {
            // Log de soumission invalide
            $logger->warning('Formulaire de contact soumis avec erreurs.', [
                'erreurs' => (string) $form->getErrors(true, false),
                'ip' => $request->getClientIp(),
                'userAgent' => $request->headers->get('User-Agent'),
            ]);
        }
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

