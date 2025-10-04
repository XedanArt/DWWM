<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookieController extends AbstractController
{
    #[Route('/cookies/preferences', name: 'cookies.preferences', methods: ['GET'])]
    public function preferences(Request $request): Response
    {
        // Récupère les préférences depuis la session
        $preferences = $request->getSession()->get('cookieConsent', [
            'statistics' => false,
            'marketing' => false
        ]);

        return $this->render('cookies/preferences.html.twig', [
            'preferences' => $preferences
        ]);
    }

    #[Route('/cookies/save', name: 'cookies.save', methods: ['POST'])]
    public function save(Request $request): Response
    {
        // Récupère les valeurs envoyées par le formulaire JS
        $statistics = filter_var($request->request->get('statistics'), FILTER_VALIDATE_BOOLEAN);
        $marketing = filter_var($request->request->get('marketing'), FILTER_VALIDATE_BOOLEAN);

        // Construit l'objet de consentement
        $preferences = [
            'statistics' => $statistics,
            'marketing' => $marketing,
            'status' => ($statistics || $marketing) ? 'accepted' : 'refused',
            'acceptedAt' => (new \DateTimeImmutable())->format('Y-m-d H:i:s'),
        ];

        // Enregistre en session
        $request->getSession()->set('cookieConsent', $preferences);

        return new Response('Consentement enregistré', 200);
    }
}