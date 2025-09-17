<?php

namespace App\Controller;

use App\Entity\Devblog;
use App\Form\DevblogType;
use App\Repository\DevblogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class DevblogController extends AbstractController
{
    #[Route('/news/devblog', name: 'news.devblog')]
    public function index(DevblogRepository $repo): Response
    {
        $devblogs = $repo->findBy([], ['date' => 'DESC']);

        return $this->render('news/devblog.html.twig', [
            'devblogs' => $devblogs
        ]);
    }

    #[Route('/news/devblog/{slug}', name: 'news.devblog.show')]
    public function show(string $slug, DevblogRepository $repo): Response
    {
        $devblog = $repo->findOneBy(['slug' => $slug]);

        if (!$devblog) {
            throw $this->createNotFoundException('Devblog introuvable.');
        }

        return $this->render('news/devblog_show.html.twig', [
            'devblog' => $devblog
        ]);
    }

    #[Route('/admin/devblog/new', name: 'admin.devblog.new')]
    public function new(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $devblog = new Devblog();
        $form = $this->createForm(DevblogType::class, $devblog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($devblog->getTitle())->lower();
            $devblog->setSlug($slug);

            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('devblog_images_directory'),
                        $newFilename
                    );
                    
                    $devblog->setImage($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Erreur lors de l\'upload de l\'image.');
                    return $this->redirectToRoute('admin.devblog.new');
                }

            }

            $em->persist($devblog);
            $em->flush();

            $this->addFlash('success', 'Devblog ajouté avec succès.');
            return $this->redirectToRoute('news.devblog');
        }

        return $this->render('admin/devblog_new.html.twig', [
            'form' => $form->createView(),
            'devblog' => $devblog
        ]);
    }
}