<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\Criteria;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class TagController extends AbstractController
{
    #[Route('/tags/search', name: 'tag.search')]
    public function search(Request $request, TagRepository $tagRepo, PaginatorInterface $paginator): JsonResponse|Response
    {
        // Autocomplétion AJAX (Select2)
        if ($request->isXmlHttpRequest()) {
            $term = trim($request->query->get('term', ''));

            if (empty($term)) {
                return new JsonResponse(['results' => []]);
            }

            $tags = $tagRepo->createQueryBuilder('t')
                ->where('LOWER(t.name) LIKE :term')
                ->setParameter('term', '%' . strtolower($term) . '%')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult();

            $results = array_map(fn($tag) => [
                'id' => $tag->getName(), // on renvoie le nom comme identifiant
                'text' => '#' . $tag->getName()
            ], $tags);

            return new JsonResponse(['results' => $results]);
        }

        // Affichage des topics liés à un tag
        $tagName = $request->query->get('tag');

        if (!$tagName || !is_string($tagName)) {
            $this->addFlash('warning', 'Aucun tag sélectionné.');
            return $this->redirectToRoute('forum_home');
        }

        $tag = $tagRepo->findOneBy(['name' => $tagName]);

        if (!$tag) {
            $this->addFlash('danger', 'Tag introuvable.');
            return $this->redirectToRoute('forum_home');
        }

        // Tri des topics liés par date de création (plus récents en premier)
        $criteria = Criteria::create()
            ->orderBy(['createdAt' => Criteria::DESC]);

        $sortedTopics = $tag->getTopics()->matching($criteria);

        // Pagination
        $pagination = $paginator->paginate(
            $sortedTopics,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('search/tag.results.html.twig', [
            'tag' => $tag,
            'pagination' => $pagination,
        ]);
    }
}