<?php
namespace App\Controller\Profile;

use App\Form\Profile\EmailFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    #[Route('/account/email', name: 'account_email')]
    public function edit(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EmailFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Email mis à jour avec succès');
        }

        return $this->render('account/edit_email.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}