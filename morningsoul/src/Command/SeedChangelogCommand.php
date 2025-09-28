<?php

namespace App\Command;

use App\Entity\Changelog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Cocur\Slugify\Slugify;

#[AsCommand(name: 'app:seed-changelog')]
class SeedChangelogCommand extends Command
{
    public function __construct(
    private EntityManagerInterface $em
    ) {
    parent::__construct();
    }
 
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
    $slugify = new Slugify();

    $entries = [
        [
            'version' => '1.0',
            'date' => '2025-09-07',
            'content' => "Ajout : système de craft\nCorrection : bug d'affichage dans l'inventaire",
            'image' => 'changelog_01.png',
        ],
        [
            'version' => '1.1',
            'date' => '2025-09-08',
            'content' => "Ajout : forum communautaire\nAmélioration : équilibrage des boss",
            'image' => 'changelog_02.png',
        ],
        [
            'version' => '1.2',
            'date' => '2025-09-09',
            'content' => "Ajout : forum communautaire\nAmélioration : équilibrage des boss",
            'image' => 'changelog_03.png',
        ],
        [
            'version' => '1.3',
            'date' => '2025-09-10',
            'content' => "Ajout : forum communautaire\nAmélioration : équilibrage des boss",
            'image' => 'changelog_04.png',
        ],
        [
            'version' => '1.4',
            'date' => '2025-09-11',
            'content' => "Ajout : forum communautaire\nAmélioration : équilibrage des boss",
            'image' => 'changelog_05.png',
        ],
        [
            'version' => '1.5',
            'date' => '2025-09-12',
            'content' => "Ajout : forum communautaire\nAmélioration : équilibrage des boss",
            'image' => 'changelog_06.png',
        ],
        [
            'version' => '1.6',
            'date' => '2025-09-13',
            'content' => "Ajout : forum communautaire\nAmélioration : équilibrage des boss",
            'image' => 'changelog_07.png',
        ],
        [
            'version' => '1.7',
            'date' => '2025-09-14',
            'content' => "Ajout : forum communautaire\nAmélioration : équilibrage des boss",
            'image' => 'changelog_08.png',
        ],
        [
            'version' => '1.8',
            'date' => '2025-09-15',
            'content' => "Ajout : forum communautaire\nAmélioration : équilibrage des boss",
            'image' => 'changelog_09.png',
        ],
        [
            'version' => '1.9',
            'date' => '2025-09-16',
            'content' => "Ajout : forum communautaire\nAmélioration : équilibrage des boss",
            'image' => 'changelog_10.png',
        ],
        [
            'version' => '1.10',
            'date' => '2025-09-17',
            'content' => "Ajout : forum communautaire\nAmélioration : équilibrage des boss",
            'image' => 'changelog_11.png',
        ],
        [
            'version' => '1.11',
            'date' => '2025-09-18',
            'content' => "Ajout : forum communautaire\nAmélioration : équilibrage des boss",
            'image' => 'changelog_12.png',
        ],
        // ...
    ];

    foreach ($entries as $entry) {
        $existing = $this->em->getRepository(Changelog::class)->findOneBy(['version' => $entry['version']]);
        if ($existing) {
            $output->writeln("Changelog version {$entry['version']} déjà présent.");
            continue;
        }

        $changelog = new Changelog();
        $changelog->setVersion($entry['version']);
        $changelog->setDate(new \DateTime($entry['date']));
        $changelog->setContent($entry['content']);
        $changelog->setImage($entry['image']);
        $changelog->setSlug($slugify->slugify("Version {$entry['version']}"));

        $this->em->persist($changelog);
        $output->writeln(" Changelog version {$entry['version']} injecté.");
    }

    $this->em->flush();
    $output->writeln('✅ Tous les changelogs ont été traités.');
    return Command::SUCCESS;
}
}