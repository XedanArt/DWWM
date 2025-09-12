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
        $consent = $request->request->get('consent');

        $preferences = match ($consent) {
            'accepted' => [
                'statistics' => true,
                'marketing' => true,
                'status' => 'accepted',
            ],
            'refused' => [
                'statistics' => false,
                'marketing' => false,
                'status' => 'refused',
            ],
            default => [
                'statistics' => false,
                'marketing' => false,
                'status' => 'unknown',
            ]
    };

    $preferences['acceptedAt'] = (new \DateTimeImmutable())->format('Y-m-d H:i:s');
    $request->getSession()->set('cookieConsent', $preferences);

    return new Response('Consentement enregistré', 200);
}
}