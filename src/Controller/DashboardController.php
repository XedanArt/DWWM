<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Devblog;
use App\Entity\Changelog;
use App\Entity\Announcement;
use App\Repository\UserRepository;
use App\Repository\DevblogRepository;
use App\Repository\ChangelogRepository;
use App\Repository\AnnouncementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Knp\Component\Pager\PaginatorInterface;

class DashboardController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/dashboard', name: 'dashboard')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAllWithRelations();
        $currentUser = $this->getUser();

        return $this->render('dashboard/index.html.twig', [
            'users' => $users,
            'user' => $currentUser
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/dashboard/contact/{id}', name: 'dashboard.contact_user')]
    public function contactUser(User $user): Response
    {
        return $this->render('dashboard/contact_user.html.twig', [
            'targetUser' => $user
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/dashboard/ban/{id}/{duration}', name: 'dashboard.ban_user')]

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

    #[Route('/dashboard/delete-user/{id}', name: 'dashboard.delete_user', methods: ['POST'])]
    public function deleteUser(int $id, EntityManagerInterface $em): Response
    {
        $user = $em->getRepository(User::class)->find($id);

        if (!$user) {
            $this->addFlash('error', 'Utilisateur introuvable.');
            return $this->redirectToRoute('dashboard');
        }

        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Utilisateur supprimé avec succès.');
        return $this->redirectToRoute('dashboard');
    } 



    #[IsGranted('ROLE_ADMIN')]
    #[Route('/dashboard/delete-entries', name: 'admin.entry.delete')]
    public function deleteEntries(
        DevblogRepository $devblogRepo,
        ChangelogRepository $changelogRepo,
        AnnouncementRepository $announcementRepo,
        Request $request,
        PaginatorInterface $paginator
    ): Response {
        $devblogs = $paginator->paginate(
            $devblogRepo->createQueryBuilder('d')->orderBy('d.date', 'DESC')->getQuery(),
            $request->query->getInt('page_devblog', 1),
            5
        );

        $changelogs = $paginator->paginate(
            $changelogRepo->createQueryBuilder('c')->orderBy('c.date', 'DESC')->getQuery(),
            $request->query->getInt('page_changelog', 1),
            5
        );

        $announcements = $paginator->paginate(
            $announcementRepo->createQueryBuilder('a')->orderBy('a.createdAt', 'DESC')->getQuery(),
            $request->query->getInt('page_announcement', 1),
            5
        );

        return $this->render('dashboard/delete_entries.html.twig', [
            'devblogs' => $devblogs,
            'changelogs' => $changelogs,
            'announcements' => $announcements
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/dashboard/delete-entry/{type}/{id}', name: 'admin.entry.delete_item', methods: ['POST'])]
    public function deleteEntry(string $type, int $id, EntityManagerInterface $em): Response
    {
        $classMap = [
            'devblog' => Devblog::class,
            'changelog' => Changelog::class,
            'announcement' => Announcement::class,
        ];

        if (!array_key_exists($type, $classMap)) {
            throw $this->createNotFoundException('Type d’entrée invalide.');
        }

        $entry = $em->getRepository($classMap[$type])->find($id);

        if (!$entry) {
            throw $this->createNotFoundException('Entrée introuvable.');
        }

        $em->remove($entry);
        $em->flush();

        $this->addFlash('success', ucfirst($type) . ' supprimé avec succès.');
        return $this->redirectToRoute('admin.entry.delete');
    }
}