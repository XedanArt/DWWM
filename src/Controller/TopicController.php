<?php

namespace App\Controller;

use App\Entity\Topic;
use App\Entity\Post;
use App\Repository\TopicRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TopicController extends AbstractController
{
    #[Route('/forum/topic/{id}', name: 'topic.show', methods: ['GET'])]
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
        $post->getCreatedAt(new \DateTimeImmutable());

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