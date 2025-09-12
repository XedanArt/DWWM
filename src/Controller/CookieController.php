<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookieController extends AbstractController
{
    #[Route('/cookies/preferences', name: 'cookies.preferences')]
    public function preferences(): Response
    {
        return $this->render('cookies/preferences.html.twig');
    }
}