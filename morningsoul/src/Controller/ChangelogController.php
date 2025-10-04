<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
            5
        );

        return $this->render('news/changelog.html.twig', [
            'pagination' => $pagination
        ]);
    }

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

    #[Route('/admin/changelog/new', name: 'admin.changelog.new')]
    public function new(Request $request, EntityManagerInterface $em, SluggerInterface $slugger, ChangelogRepository $repo): Response
    {
        if (!$this->isGranted('ROLE_ADMIN') && !$this->isGranted('ROLE_SUPER_ADMIN')) {
            throw $this->createAccessDeniedException();
        }

        $changelog = new Changelog();
        $changelog->setDate(new \DateTime());

        $form = $this->createForm(ChangelogType::class, $changelog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Génération du slug
            $baseSlug = $slugger->slug($changelog->getVersion())->lower();
            $slug = $baseSlug;
            $counter = 1;

            while ($repo->findOneBy(['slug' => $slug])) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $changelog->setSlug($slug);

            // Gestion de l'image uploadée
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('changelog_images_dir'),
                        $newFilename
                    );
                    $changelog->setImage($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l’upload de l’image.');
                    return $this->redirectToRoute('admin.changelog.new');
                }
            }

            $em->persist($changelog);
            $em->flush();

            $this->addFlash('success', 'Le changelog a été ajouté avec succès.');
            return $this->redirectToRoute('news.changelog', ['page' => 1]);
        }

        return $this->render('admin/changelog_new.html.twig', [
            'form' => $form->createView(),
            'changelog' => $changelog,
        ]);
    }
}