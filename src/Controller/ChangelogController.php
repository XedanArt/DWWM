<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;
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
    // Affichage de la vue changelog (index)
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

    // affichage d'un slug si il y en a un
    #[Route('/news/changelog/{slug}', name: 'news.changelog.show')]
    public function show(string $slug, ChangelogRepository $repo): Response
    {
        $changelog = $repo->findOneBy(['slug' => $slug]);

        if (!$changelog) {
            throw $this->createNotFoundException('Changelog introuvable.');
        }

        return $this->render('news/changelog_show.html.twig', [
            'changelog' => $changelog
        ]);
    }

    // Route vers le formulaire de création d'un changelog
    #[Route('/admin/changelog/new', name: 'admin.changelog.new')]
    public function new(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        if (!$this->isGranted('ROLE_ADMIN') && !$this->isGranted('ROLE_SUPER_ADMIN')) {
            throw $this->createAccessDeniedException();
        }

        $changelog = new Changelog();
        $changelog->setDate(new \DateTime());
        $form = $this->createForm(ChangelogType::class, $changelog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($changelog->getVersion())->lower();
            $changelog->setSlug($slug);

            $em->persist($changelog);
            $em->flush();

            $this->addFlash('success', 'Le changelog a été ajouté avec succès.');
            return $this->redirectToRoute('news.changelog', ['page' => 1]);
        }

        return $this->render('admin/changelog_new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}