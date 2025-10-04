<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalsController extends AbstractController
{
    #[Route('legals/privacy', name: 'legals.privacy')]
    public function privacy(): Response
    {
        return $this->render('legals/privacy.html.twig');
    }

    #[Route('legals/legal', name: 'legals.legal')]
    public function legals(): Response
    {
        return $this->render('legals/legal.html.twig');
    }

    #[Route('legals/terms', name: 'legals.terms')]
    public function terms(): Response
    {
        return $this->render('legals/terms.html.twig');
    }

    #[Route('legals/cookies', name: 'legals.cookies')]
    public function cookies(): Response
    {
        return $this->render('legals/cookies.html.twig');
    }
}