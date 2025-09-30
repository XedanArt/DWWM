<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ChangelogRepository;
use App\Repository\DevblogRepository;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'sitemap')]
    public function sitemap(
        UrlGeneratorInterface $urlGenerator,
        ChangelogRepository $changelogRepository,
        DevblogRepository $devblogRepository
    ): Response {
        $urls = [
            ['loc' => $urlGenerator->generate('homepage.index', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('app_login', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('auth.register', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('auth.forgot_password', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('news.changelog', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('news.devblog', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('contact.support', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('contact.socials', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('legals.privacy', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('legals.legal', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('legals.terms', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('legals.cookies', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('cookies.save', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('cookies.preferences', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('game.discover', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('game.download', [], UrlGeneratorInterface::ABSOLUTE_URL)],
            ['loc' => $urlGenerator->generate('external_redirect', [], UrlGeneratorInterface::ABSOLUTE_URL)],
        ];

        // Boucle sur les changelogs publiés
        foreach ($changelogRepository->findPublished() as $changelog) {
            $urls[] = [
                'loc' => $urlGenerator->generate('news.changelog.show', [
                    'slug' => $changelog->getSlug()
                ], UrlGeneratorInterface::ABSOLUTE_URL)
            ];
        }

        // Boucle sur les devblogs publiés
        foreach ($devblogRepository->findPublished() as $post) {
            $urls[] = [
                'loc' => $urlGenerator->generate('news.devblog.show', [
                    'slug' => $post->getSlug()
                ], UrlGeneratorInterface::ABSOLUTE_URL)
            ];
        }

        $xml = new \SimpleXMLElement('<urlset/>');
        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($urls as $url) {
            $urlElement = $xml->addChild('url');
            $urlElement->addChild('loc', $url['loc']);
        }

        return new Response($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
    }
}