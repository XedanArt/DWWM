<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\PresentationRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


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
    public function download(): Response {
        return $this->render('game/download.html.twig');
    }

    // contact > support
    #[Route('/contact/support', name: 'contact.support')]
    public function support(
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $form = $this -> createForm(ContactType::class);
        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contact=$form->getData();
            $em->persist($contact);
            $em->flush();
        }
        return $this->render('contact/support.html.twig', [
            "form" => $form -> createView()
        ]);
    }

    // contact > socials
    #[Route('/contact/socials', name: 'contact.socials')]
    public function socials(): Response {
        return $this->render('contact/socials.html.twig');
    }

    // news > changelog
    #[Route('/news/changelog', name: 'news.changelog')]
    public function changelog(): Response {
        return $this->render('news/changelog.html.twig');
    }

    // news > devblog
    #[Route('/news/devblog', name: 'news.devblog')]
    public function devblog(): Response {
        return $this->render('news/devblog.html.twig');
    }
} 

