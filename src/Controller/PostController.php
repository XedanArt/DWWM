<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Topic;
use App\Repository\TopicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PostController extends AbstractController
{
    #[Route('/post/create/{topicId}', name: 'post.create', methods: ['POST'])]
    public function create(Request $request, TopicRepository $topicRepo, EntityManagerInterface $em, int $topicId): Response
    {
    $user = $this->getUser();
    if (!$user) {
        return $this->redirectToRoute('app_login');
    }

    $topic = $topicRepo->find($topicId);
    if (!$topic) {
        throw $this->createNotFoundException('Topic non trouvé');
    }

    if ($topic->isQuarantined()) {
        $this->addFlash('warning', 'Ce topic est en quarantaine. Vous ne pouvez pas y répondre.');
        return $this->redirectToRoute('topic.show', ['id' => $topicId]);
    }

    $content = trim($request->request->get('content'));
    if (empty($content)) {
        $this->addFlash('error', 'Votre réponse ne peut pas être vide.');
        return $this->redirectToRoute('topic.show', ['id' => $topicId]);
    }

    $post = new Post();
    $post->setContent($content);
    $post->setUser($user);
    $post->setTopic($topic);
    // Pas besoin de setCreatedAt ici, c’est géré dans le constructeur

    $em->persist($post);
    $em->flush();

    $this->addFlash('success', 'Réponse ajoutée avec succès !');

    return $this->redirectToRoute('topic.show', ['id' => $topicId]);
}
}