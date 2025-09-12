<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Form\AnnouncementType;
use App\Repository\AnnouncementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class AnnouncementController extends AbstractController
{
    #[Route('/forum', name: 'forum.index')]
    public function index(AnnouncementRepository $repo): Response
    {
        $announcements = $repo->findBy([], ['createdAt' => 'DESC']);

        return $this->render('forum/index.html.twig', [
            'announcements' => $announcements
        ]);
    }

    #[Route('/admin/announcement/new', name: 'admin.announcement.new')]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        #[Autowire(service: 'monolog.logger.admin_actions')] LoggerInterface $logger
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $announcement = new Announcement();
        $announcement->setAuthor($this->getUser());

        $form = $this->createForm(AnnouncementType::class, $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($announcement);
            $em->flush();

            $logger->info('Annonce créée par un administrateur', [
                'admin_id' => $this->getUser()->getId(),
                'title' => $announcement->getTitle(),
                'created_at' => $announcement->getCreatedAt()?->format('Y-m-d H:i:s'),
            ]);

            $this->addFlash('success', 'Annonce ajoutée avec succès.');
            return $this->redirectToRoute('forum.index');
        }

        return $this->render('admin/announcement_new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/announcement/delete/{id}', name: 'admin.announcement.delete', methods: ['POST'])]
    public function delete(
        Announcement $announcement,
        EntityManagerInterface $em,
        #[Autowire(service: 'monolog.logger.admin_actions')] LoggerInterface $logger
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $logger->warning('Annonce supprimée par un administrateur', [
            'admin_id' => $this->getUser()->getId(),
            'announcement_id' => $announcement->getId(),
            'title' => $announcement->getTitle(),
        ]);

        $em->remove($announcement);
        $em->flush();

        $this->addFlash('success', 'Annonce supprimée avec succès.');
        return $this->redirectToRoute('forum.index'); // correction ici
    }
}