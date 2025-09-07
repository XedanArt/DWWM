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
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $announcement = new Announcement();
        $announcement->setAuthor($this->getUser());

        $form = $this->createForm(AnnouncementType::class, $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($announcement);
            $em->flush();

            $this->addFlash('success', 'Annonce ajoutée avec succès.');
            return $this->redirectToRoute('forum.index');
        }

        return $this->render('admin/announcement_new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/announcement/delete/{id}', name: 'admin.announcement.delete', methods: ['POST'])]
    public function delete(Announcement $announcement, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $em->remove($announcement);
        $em->flush();

        $this->addFlash('success', 'Annonce supprimée avec succès.');
        return $this->redirectToRoute('admin.entry.delete');
    }
}