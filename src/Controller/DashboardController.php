<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAllWithRelations();
        $currentUser = $this->getUser();

        return $this->render('dashboard/index.html.twig', [
            'users' => $users,
            'user' => $currentUser
        ]);
    }

    #[Route('/dashboard/contact/{id}', name: 'dashboard.contact_user')]
    #[IsGranted('ROLE_ADMIN')]
    public function contactUser(User $user): Response
    {
        return $this->render('dashboard/contact_user.html.twig', [
            'targetUser' => $user
        ]);
    }

    #[Route('/dashboard/ban/{id}/{duration}', name: 'dashboard.ban_user')]
    #[IsGranted('ROLE_ADMIN')]
    public function banUser(User $user, int $duration, EntityManagerInterface $em): Response
    {
        $banUntil = new \DateTimeImmutable("+{$duration} hours");

        $user->setRoles(['ROLE_BANNED']);
        $user->setLastLogin($banUntil); // Remplacer par setBanUntil si tu ajoutes cette propriété

        $em->persist($user);
        $em->flush();

        return $this->render('dashboard/ban_user.html.twig', [
            'bannedUser' => $user,
            'duration' => $duration
        ]);
    }

    #[Route('/dashboard/delete/{id}', name: 'dashboard.delete_user')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteUser(User $user, EntityManagerInterface $em): Response
    {
        $em->remove($user);
        $em->flush();

        return $this->render('dashboard/delete_user.html.twig', [
            'deletedUser' => $user
        ]);
    }

    #[Route('/superadmin/create', name: 'superadmin.create_admin')]
    #[IsGranted('ROLE_SUPER_ADMIN')]
    public function promoteUser(User $user, EntityManagerInterface $em): Response
    {
        $user->setRoles(['ROLE_ADMIN']);

        $em->persist($user);
        $em->flush();

        return $this->render('superadmin/create_admin.html.twig', [
            'promotedUser' => $user
        ]);
    }

    #[Route('/superadmin/revoke', name: 'superadmin.revoke_admin')]
    #[IsGranted('ROLE_SUPER_ADMIN')]
    public function demoteUser(User $user, EntityManagerInterface $em): Response
    {
        $user->setRoles(['ROLE_USER']);

        $em->persist($user);
        $em->flush();

        return $this->render('superadmin/revoke_admin.html.twig', [
            'revokedUser' => $user
        ]);
    }
}