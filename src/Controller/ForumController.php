<?php

namespace App\Controller;

use App\Entity\ForumSection;
use App\Entity\Topic;
use App\Entity\Tag;
use App\Form\TopicFormType;
use App\Repository\AnnouncementRepository;
use App\Repository\ForumSectionRepository;
use App\Repository\TopicRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ForumController extends AbstractController
{
    #[Route('/forum', name: 'forum.index')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(
        AnnouncementRepository $announcementRepository,
        TopicRepository $topicRepository,
        ForumSectionRepository $sectionRepository,
        TagRepository $tagRepository,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $announcements   = $announcementRepository->findLatest(3);
        $topics          = $topicRepository->findBy([], ['createdAt' => 'DESC'], 6);
        $featuredTopics  = $topicRepository->findBy([], ['createdAt' => 'DESC'], 2);
        $rawSections     = $sectionRepository->findActiveSections();
        $tags            = $tagRepository->findAll();

        $sections = array_values(array_filter($rawSections, fn($s) => $s instanceof ForumSection));

        // Préparer les tags soumis pour affichage dans Select2
        $preselectedTags = [];

        if ($request->isMethod('POST')) {
            $formData = $request->request->all('topic');
            $rawTags = $formData['tags'] ?? [];

            if (is_array($rawTags)) {
                foreach ($rawTags as $tag) {
                    if (is_scalar($tag)) {
                        $tag = trim($tag);
                        if ($tag !== '') {
                            $preselectedTags[$tag] = $tag;
                        }
                    }
                }
            }
        }

        $topic = new Topic();
        $form = $this->createForm(TopicFormType::class, $topic, [
            'preselected_tags' => $preselectedTags,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                foreach ($form->getErrors(true) as $error) {
                    dump($error->getOrigin()->getName(), $error->getMessage());
                }
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $topic->setAuthor($this->getUser());
            $topic->updateLastActivity();

            // Vérification d'unicité du titre (insensible à la casse)
            $normalizedTitle = mb_strtolower($topic->getTitle());
            $existing = $topicRepository->createQueryBuilder('t')
                ->where('LOWER(t.title) = :title')
                ->setParameter('title', $normalizedTitle)
                ->getQuery()
                ->getOneOrNullResult();

            if ($existing) {
                $this->addFlash('danger', 'Un topic avec ce titre existe déjà.');
                return $this->redirectToRoute('forum.index');
            }

            $submittedTags = $form->get('tags')->getData(); // tableau direct

            foreach ($submittedTags as $tagName) {
                $tagName = trim($tagName);
                if (!preg_match('/^[\p{L}0-9\-_\s]+$/u', $tagName)) continue;
                if ($tagName === '') continue;

                $existingTag = $tagRepository->findOneBy(['name' => $tagName]);
                if ($existingTag) {
                    $topic->addTag($existingTag);
                } else {
                    $newTag = new Tag();
                    $newTag->setName($tagName);
                    $em->persist($newTag);
                    $topic->addTag($newTag);
                }
            }

            $em->persist($topic);
            $em->flush();

            $this->addFlash('success', 'Topic créé dans la section "' . $topic->getSection()->getTitle() . '"');
            return $this->redirectToRoute('topic.show', ['id' => $topic->getId()]);
        }

        return $this->render('forum/index.html.twig', [
            'announcements'  => $announcements,
            'topics'         => $topics,
            'featuredTopics' => $featuredTopics,
            'sections'       => $sections,
            'tags'           => $tags,
            'form'           => $form->createView(),
        ]);
    }

    #[Route('/forum/section/{slug}', name: 'forum_section')]
    public function showSection(
        string $slug,
        Request $request,
        ForumSectionRepository $repo,
        TopicRepository $topicRepo,
        PaginatorInterface $paginator
    ): Response {
        $section = $repo->findOneBy(['slug' => $slug]);

        if (!$section) {
            throw $this->createNotFoundException("Section introuvable !");
        }

        $query = $topicRepo->createQueryBuilder('t')
            ->where('t.section = :section')
            ->setParameter('section', $section)
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('forum/section_detail.html.twig', [
            'section'    => $section,
            'topics'     => $pagination,
            'topicCount' => $pagination->getTotalItemCount(),
        ]);
    }

    #[Route('/forum/rules', name: 'forum.rules')]
    public function rules(): Response
    {
        return $this->render('forum/rules.html.twig');
    }
}