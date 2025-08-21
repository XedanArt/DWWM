<?php

namespace App\Controller\Profile;

use App\Form\Profile\AvatarFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AvatarController extends AbstractController
{
    #[Route('/account/avatar', name: 'account_avatar')]
    public function edit(Request $request, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AvatarFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedFile = $form->get('avatar')->getData();

            if ($uploadedFile) {
                $safeName = $slugger->slug(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME));
                $newFilename = $safeName . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

                try {
                    $uploadedFile->move($this->getParameter('avatars_directory'), $newFilename);
                    $user->setAvatar($newFilename);
                    $this->getDoctrine()->getManager()->flush();

                    $this->addFlash('success', 'Avatar mis à jour !');
                } catch (FileException $e) {
                    $this->addFlash('danger', "Erreur lors de l'upload de l'image.");
                }
            } else {
                $this->addFlash('warning', "Aucune image sélectionnée.");
            }
        }

        return $this->render('account/edit_avatar.html.twig', [
            'form' => $form->createView(),
            'currentAvatar' => $user->getAvatar(),
        ]);
    }
}