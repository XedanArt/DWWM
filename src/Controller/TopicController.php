<?php

namespace App\Controller;

use App\Entity\Topic;
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
            throw $this->createNotFoundException('Ce topic n’existe pas.');
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
}