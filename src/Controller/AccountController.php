<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Profile\UsernameFormType;
use App\Form\Profile\EmailFormType;
use App\Form\Profile\AvatarFormType;
use App\Form\Profile\BioFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[IsGranted('ROLE_USER')]
class AccountController extends AbstractController
{
    #[Route('/account', name: 'account.profile')]
    public function profile(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        // Créer les formulaires
        $usernameForm = $this->createForm(UsernameFormType::class, $user);
        $emailForm    = $this->createForm(EmailFormType::class, $user);
        $avatarForm   = $this->createForm(AvatarFormType::class);
        $bioForm      = $this->createForm(BioFormType::class, $user);

        // Gérer les soumissions
        $usernameForm->handleRequest($request);
        $emailForm->handleRequest($request);
        $avatarForm->handleRequest($request);
        $bioForm->handleRequest($request);

        if ($usernameForm->isSubmitted() && $usernameForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Pseudo mis à jour !');
            return $this->redirectToRoute('account.profile');
        }

        if ($emailForm->isSubmitted() && $emailForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Email mis à jour !');
            return $this->redirectToRoute('account.profile');
        }

        if ($avatarForm->isSubmitted() && $avatarForm->isValid()) {
            $file = $avatarForm->get('avatar')->getData();
            if ($file) {
                $safeName = $slugger->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $filename = $safeName . '-' . uniqid() . '.' . $file->guessExtension();

                try {
                    $file->move($this->getParameter('avatars_directory'), $filename);

                    // Supprimer l’ancien avatar
                    $oldAvatar = $user->getAvatar();
                    if ($oldAvatar && $oldAvatar !== 'default-avatar.png') {
                      $oldPath = $this->getParameter('avatars_directory') . '/' . $oldAvatar;
                      if (file_exists($oldPath)) {
                      unlink($oldPath);
                      }
                    }

                    $user->setAvatar($filename);
                    $em->flush();
                    $this->addFlash('success', 'Avatar mis à jour !');
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Erreur lors de l’envoi de l’image.');
                }
            } else {
                $this->addFlash('warning', 'Aucune image sélectionnée.');
            }

            return $this->redirectToRoute('account.profile');
        }

        if ($bioForm->isSubmitted() && $bioForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Biographie mise à jour !');
            return $this->redirectToRoute('account.profile');
        }

        // Rendu du template avec tout ce qu’il faut
        return $this->render('account/profile.html.twig', [
            'usernameForm' => $usernameForm->createView(),
            'emailForm'    => $emailForm->createView(),
            'avatarForm'   => $avatarForm->createView(),
            'bioForm'      => $bioForm->createView(),
            'currentAvatar'=> $user->getAvatar(),
            'topics'       => $user?->getTopics() ?? [],
            'posts'        => $user?->getPosts() ?? [],
            'favorites'    => $user?->getFavoriteTopics() ?? [],
        ]);
    }
}