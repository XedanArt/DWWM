<?php

namespace App\Command;

use App\Entity\ForumSection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

// php bin/console app:seed-forum-sections
#[AsCommand(name: 'app:seed-forum-sections')]
class SeedForumSectionsCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private SluggerInterface $slugger
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($this->em->getRepository(ForumSection::class)->count() > 0) {
            $output->writeln('Sections déjà présentes.');
            return Command::SUCCESS;
        }

        $sections = [
            ['Feu de Camp', 'Discussions générales entre joueurs, entraide et détente, autour du jeu.'],
            ['Lore & Théories', 'Hypothèses sur l’univers du jeu, secrets et interprétations.'],
            ['Boss & Ennemis', 'Stratégies de combat et analyse des créatures redoutables.'],
            ['Builds & Équipement', 'Partage de configurations, optimisation et objets légendaires.'],
            ['Zones & Level Design', 'Exploration, secrets et architecture des lieux.'],
            ['Discussion', 'Espace libre pour échanger autour de tout et n’importe quoi.'],
            ['Suggestions & Améliorations', 'Propositions pour faire évoluer le projet et affiner le gameplay.'],
            ['Sanctuaire du Code', 'Espace technique : bugs, moteur, alpha/bêta et retours devs.'],
            // ...
        ];

        foreach ($sections as [$title, $desc]) {
            $section = new ForumSection();
            $section->setTitle($title);
            $section->setSlug($this->slugger->slug($title)->lower());
            $section->setDescription($desc);
            $section->setType('discussion');
            $section->setIsActive(true);
            $section->setIsVisible(true);
            $section->setCreatedAt(new \DateTimeImmutable());

            $this->em->persist($section);
        }

        $this->em->flush();
        $output->writeln('Sections créées.');
        return Command::SUCCESS;
    }
}