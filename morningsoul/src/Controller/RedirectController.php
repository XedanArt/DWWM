<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController extends AbstractController
{
    #[Route('/redirect', name: 'external_redirect')]
    public function confirmExternalRedirect(Request $request): Response
    {
        $target = $request->query->get('target');
        $decodedTarget = urldecode($target);

        // Sécurité : valider que c’est bien une URL externe
        if (!$decodedTarget || !filter_var($decodedTarget, FILTER_VALIDATE_URL)) {
            throw $this->createNotFoundException('Lien invalide.');
        }

        return $this->render('redirect/confirm.html.twig', [
            'target' => $decodedTarget,
        ]);
    }
}