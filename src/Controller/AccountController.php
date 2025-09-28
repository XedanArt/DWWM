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
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Knp\Component\Pager\PaginatorInterface;

#[IsGranted('ROLE_USER')]
class AccountController extends AbstractController
{
    #[Route('/account', name: 'account.profile')]
    public function profile(
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger,
        #[Autowire(service: 'monolog.logger.account')] LoggerInterface $accountLogger,
        #[Autowire(service: 'monolog.logger.content_modif')] LoggerInterface $contentLogger
    ): Response {
        /** @var User $user */
        $user = $this->getUser();

        $accountLogger->info('Accès au profil utilisateur', [
            'user_id' => $user->getId(),
            'username' => $user->getUsername(),
        ]);

        $usernameForm = $this->createForm(UsernameFormType::class, $user);
        $emailForm    = $this->createForm(EmailFormType::class, $user);
        $avatarForm   = $this->createForm(AvatarFormType::class);
        $bioForm      = $this->createForm(BioFormType::class, $user);

        $usernameForm->handleRequest($request);
        $emailForm->handleRequest($request);
        $avatarForm->handleRequest($request);
        $bioForm->handleRequest($request);

        if ($usernameForm->isSubmitted()) {
            $contentLogger->info('Tentative de modification du pseudo', [
                'user_id' => $user->getId(),
                'ancien_pseudo' => $user->getUsername(),
                'valide' => $usernameForm->isValid(),
            ]);
        }

        if ($usernameForm->isSubmitted() && $usernameForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Pseudo mis à jour !');
            return $this->redirectToRoute('account.profile');
        }

        if ($emailForm->isSubmitted()) {
            $contentLogger->info('Tentative de modification de l’email', [
                'user_id' => $user->getId(),
                'ancien_email' => $user->getEmail(),
                'valide' => $emailForm->isValid(),
            ]);
        }

        if ($emailForm->isSubmitted() && $emailForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Email mis à jour !');
            return $this->redirectToRoute('account.profile');
        }

        if ($avatarForm->isSubmitted()) {
            $contentLogger->info('Tentative de modification de l’avatar', [
                'user_id' => $user->getId(),
                'valide' => $avatarForm->isValid(),
            ]);
        }

        if ($avatarForm->isSubmitted() && $avatarForm->isValid()) {
            $file = $avatarForm->get('avatar')->getData();

            if ($file) {
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
                    $this->addFlash('danger', 'Format d’image non autorisé.');
                    return $this->redirectToRoute('account.profile');
                }

                $safeName = $slugger->slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $filename = $safeName . '-' . uniqid() . '.' . $file->guessExtension();

                try {
                    $file->move($this->getParameter('avatars_directory'), $filename);

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

        if ($bioForm->isSubmitted()) {
            $contentLogger->info('Tentative de modification de la biographie', [
                'user_id' => $user->getId(),
                'valide' => $bioForm->isValid(),
            ]);
        }

        if ($bioForm->isSubmitted() && $bioForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Biographie mise à jour !');
            return $this->redirectToRoute('account.profile');
        }

        return $this->render('account/profile.html.twig', [
            'usernameForm'   => $usernameForm->createView(),
            'emailForm'      => $emailForm->createView(),
            'avatarForm'     => $avatarForm->createView(),
            'bioForm'        => $bioForm->createView(),
            'currentAvatar'  => $user->getAvatar(),
        ]);
    }

    #[Route('/account/favorites', name: 'account.favorites')]
    #[IsGranted('ROLE_USER')]
    public function favorites(Request $request, PaginatorInterface $paginator): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $favoritesPagination = $paginator->paginate(
            $user->getFavoriteTopics()->toArray(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('account/favorites.html.twig', [
            'favorites' => $favoritesPagination,
        ]);
    }

    #[Route('/account/history', name: 'account.history')]
    #[IsGranted('ROLE_USER')]
    public function history(Request $request, PaginatorInterface $paginator): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $topicsPagination = $paginator->paginate(
            $user->getTopics()->toArray(),
            $request->query->getInt('topicPage', 1),
            5,
            ['pageParameterName' => 'topicPage']
        );

        $postsPagination = $paginator->paginate(
            $user->getPosts()->toArray(),
            $request->query->getInt('postPage', 1),
            5,
            ['pageParameterName' => 'postPage']
        );

        return $this->render('account/history.html.twig', [
            'topics' => $topicsPagination,
            'posts'  => $postsPagination,
        ]);
    }

    #[Route('/account/security', name: 'account.security')]
    #[IsGranted('ROLE_USER')]
    public function security(): Response
    {
        return $this->render('account/security.html.twig');
    }
}