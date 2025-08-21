<?php
namespace App\Controller\Profile;

use App\Form\Profile\UsernameFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsernameController extends AbstractController
{
    #[Route('/account/username', name: 'account_username')]
    public function edit(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UsernameFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Pseudo mis à jour !');
        }

        return $this->render('account/edit_username.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}