<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ChangelogRepository;
use App\Entity\Changelog;
use App\Form\ChangelogType;
use Knp\Component\Pager\PaginatorInterface;

final class ChangelogController extends AbstractController
{
    #[Route('/news/changelog', name: 'news.changelog')]
    public function index(Request $request, ChangelogRepository $repo, PaginatorInterface $paginator): Response
    {
        $query = $repo->createQueryBuilder('c')
                      ->orderBy('c.date', 'DESC')
                      ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5 // Nombre d’éléments par page
        );

        return $this->render('news/changelog.html.twig', [
            'pagination' => $pagination
        ]);
    }

    #[Route('/admin/changelog/new', name: 'admin.changelog.new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isGranted('ROLE_ADMIN') && !$this->isGranted('ROLE_SUPER_ADMIN')) {
            throw $this->createAccessDeniedException();
        }

        $changelog = new Changelog();
        $form = $this->createForm(ChangelogType::class, $changelog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($changelog);
            $em->flush();

            $this->addFlash('success', 'Le changelog a été ajouté avec succès.');
            return $this->redirectToRoute('news.changelog');
        }

        return $this->render('admin/changelog_new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}