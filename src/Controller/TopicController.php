<?php

namespace App\Controller;

use App\Entity\Topic;
use App\Entity\Post;
use App\Entity\Tag;
use App\Form\TopicFormType;
use App\Repository\TopicRepository;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TopicController extends AbstractController
{
    #[Route('/forum/topic/{id}', name: 'topic.show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(
        int $id,
        TopicRepository $topicRepo,
        PostRepository $postRepo,
        Request $request,
        PaginatorInterface $paginator,
        EntityManagerInterface $em
    ): Response {
        $topic = $topicRepo->find($id);

        if (!$topic) {
            return $this->render('error/topic_not_found.html.twig');
        }

        $topic->incrementViewCount();
        $topic->updateLastActivity();
        $em->flush();

        $query = $postRepo->createQueryBuilder('p')
            ->where('p.topic = :topic')
            ->setParameter('topic', $topic)
            ->orderBy('p.createdAt', 'ASC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('forum/topic.show.html.twig', [
            'topic' => $topic,
            'pagination' => $pagination,
        ]);
    }

    #[Route('/forum/topic/new', name: 'topic_new', methods: ['GET', 'POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function new(Request $request, EntityManagerInterface $em, TagRepository $tagRepo): Response
    {
        $topic = new Topic();

        // Injecter les tags existants
        $existingTags = $tagRepo->findAll();
        $form = $this->createForm(TopicFormType::class, $topic, [
            'available_tags' => $existingTags
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rawTags = $form->get('tags')->getData();

            if (is_array($rawTags)) {
                $submittedTags = array_filter(array_map('trim', $rawTags));
            } elseif (is_string($rawTags)) {
                $submittedTags = array_filter(array_map('trim', explode(',', $rawTags)));
            } else {
                $submittedTags = [];
            }

            $submittedTags = array_unique($submittedTags);

            if (count($submittedTags) > 10) {
                $this->addFlash('danger', 'Vous ne pouvez pas ajouter plus de 10 tags.');
                return $this->redirectToRoute('topic_new');
            }

            foreach ($submittedTags as $tagName) {
                if (!preg_match('/^[\p{L}0-9\-_\s]{2,30}$/u', $tagName)) continue;

                $tag = $tagRepo->findOneBy(['name' => $tagName]);
                if (!$tag) {
                    $tag = new Tag();
                    $tag->setName($tagName);
                    $em->persist($tag);
                }

                $topic->addTag($tag);
            }

            // Nettoyage du contenu TinyMCE, très important pour éviter les balises parasites
            $content = $topic->getContent();
            // Supprime les balises p, span, englobantes
            $content = preg_replace('/^<(p|span)[^>]*>(.*?)<\/\1>$/is', '$2', trim($content));
            // Supprime les balises vides ou parasites
            $content = strip_tags($content, '<b><strong><i><em><br>');

            $topic->setContent($content);

            $topic->setAuthor($this->getUser());
            $topic->setCreatedAt(new \DateTimeImmutable());

            $em->persist($topic);
            $em->flush();

            $this->addFlash('success', 'Sujet créé avec succès !');
            return $this->redirectToRoute('topic.show', ['id' => $topic->getId()]);
        }

        return $this->render('forum/new.html.twig', [
            'form' => $form,
            'tags' => $tagRepo->findAll(),
        ]);
    }

    #[Route('/forum/topic/{id}/favorite', name: 'topic.toggle_favorite', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function toggleFavorite(Topic $topic, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if ($user->getFavoriteTopics()->contains($topic)) {
            $user->removeFavoriteTopic($topic);
            $this->addFlash('info', 'Topic retiré des favoris.');
        } else {
            $user->addFavoriteTopic($topic);
            $this->addFlash('success', 'Topic ajouté aux favoris.');
        }

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('topic.show', ['id' => $topic->getId()]);
    }

    #[Route('/forum/topic/{id}/quarantine', name: 'topic.quarantine', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function quarantine(Topic $topic, EntityManagerInterface $em): Response
    {
        $topic->setIsQuarantined(true);
        $em->flush();

        $this->addFlash('warning', 'Le topic a été mis en quarantaine.');
        return $this->redirectToRoute('topic.show', ['id' => $topic->getId()]);
    }

    #[Route('/forum/topic/{id}/post', name: 'post.create', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function createPost(Topic $topic, Request $request, EntityManagerInterface $em): Response
    {
        if ($topic->isQuarantined()) {
            $this->addFlash('warning', 'Ce topic est en quarantaine. Vous ne pouvez pas y répondre.');
            return $this->redirectToRoute('topic.show', ['id' => $topic->getId()]);
        }

        $content = trim($request->request->get('content'));

        if (!$content) {
            $this->addFlash('danger', 'Le contenu du message ne peut pas être vide.');
            return $this->redirectToRoute('topic.show', ['id' => $topic->getId()]);
        }

        $post = new Post();
        $post->setContent($content);
        $post->setTopic($topic);
        $post->setUser($this->getUser());

        $em->persist($post);
        $em->flush();

        $this->addFlash('success', 'Votre réponse a été publiée.');
        return $this->redirectToRoute('topic.show', ['id' => $topic->getId()]);
    }

    #[Route('/forum/topic/{id}/delete', name: 'topic.delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Topic $topic, EntityManagerInterface $em): Response
    {
        $em->remove($topic);
        $em->flush();

        $this->addFlash('danger', 'Le topic a été supprimé définitivement.');
        return $this->redirectToRoute('dashboard');
    }

    #[Route('/forum/topic/{id}/restore', name: 'topic.restore', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function restore(Topic $topic, EntityManagerInterface $em): Response
    {
        $topic->setIsQuarantined(false);
        $em->flush();

        $this->addFlash('success', 'Le topic a été restauré.');
        return $this->redirectToRoute('topic.quarantine.list');
    }

    #[Route('/admin/quarantine-topics', name: 'topic.quarantine.list', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function listQuarantinedTopics(TopicRepository $topicRepo): Response
    {
        $topics = $topicRepo->findBy(['isQuarantined' => true]);

        return $this->render('admin/topic_quarantine_list.html.twig', [
            'topics' => $topics
        ]);
    }
}