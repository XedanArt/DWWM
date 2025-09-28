<?php

namespace App\Command;

use App\Entity\Devblog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Cocur\Slugify\Slugify;

#[AsCommand(name: 'app:seed-devblogs')]
class SeedDevblogsCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $slugify = new Slugify();

        $entries = [
            [
                'title' => 'Bienvenue dans Morning Soul',
                'content' => "Premiers pas dans l’univers du projet. Présentation des mécaniques, intentions de design, et appel à la communauté.",
                'date' => '2025-09-01',
                'image' => 'devblog_01.png',
            ],
            [
                'title' => 'Système de craft et équilibrage',
                'content' => "Présentation du système de fabrication d’objets, retours sur les premiers tests, et ajustements des ressources.",
                'date' => '2025-09-15',
                'image' => 'devblog_02.png',
            ],
            [
                'title' => 'Refonte du forum communautaire',
                'content' => "Mise en place des sections, tags, et modération. Objectif : favoriser les échanges et la co-construction.",
                'date' => '2025-09-28',
                'image' => 'devblog_03.png',
            ],
        ];

        foreach ($entries as $entry) {
            $slug = $slugify->slugify($entry['title']);
            $existing = $this->em->getRepository(Devblog::class)->findOneBy(['slug' => $slug]);

            if ($existing) {
                $output->writeln("❌ Devblog déjà présent : {$entry['title']}");
                continue;
            }

            $devblog = new Devblog();
            $devblog->setTitle($entry['title']);
            $devblog->setContent($entry['content']);
            $devblog->setDate(new \DateTime($entry['date']));
            $devblog->setImage($entry['image']);
            $devblog->setSlug($slug);

            $this->em->persist($devblog);
            $output->writeln("✅ Devblog injecté : {$entry['title']}");
        }

        $this->em->flush();
        $output->writeln('🎉 Tous les devblogs ont été traités.');
        return Command::SUCCESS;
    }
}