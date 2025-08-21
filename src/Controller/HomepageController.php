<?php

namespace App\Controller;


use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomepageController extends AbstractController 
{
    // [URL + NOM DE LA ROUTE, index = accueil)]
    #[Route('/homepage', name: 'homepage.index')]
    public function index(): Response {
       return $this->render('homepage/index.html.twig');
    }

    // game > discover
    #[Route('/game/discover', name: 'game.discover')]
    public function discover(): Response {
        return $this->render('game/discover.html.twig');
    }

    // game > download
    #[Route('/game/download', name: 'game.download')]
    public function download(): Response {
        return $this->render('game/download.html.twig');
    }

    // contact > support
    #[Route('/contact/support', name: 'contact.support')]
    public function support(): Response {
        return $this->render('contact/support.html.twig');
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

