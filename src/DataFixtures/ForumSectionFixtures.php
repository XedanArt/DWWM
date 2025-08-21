<?php

namespace App\DataFixtures;

use App\Entity\ForumSection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ForumSectionFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger) {}

    public function load(ObjectManager $manager): void
    {
        $sections = [
            ['Feu de Camp', 'Discussions générales entre joueurs, entraide et détente.'],
            ['Lore & Théories', 'Hypothèses sur l’univers du jeu, secrets et interprétations.'],
            ['Boss & Ennemis', 'Stratégies de combat et analyse des créatures redoutables.'],
            ['Builds & Équipement', 'Partage de configurations, optimisation et objets légendaires.'],
            ['Zones & Level Design', 'Exploration, secrets et architecture des lieux maudits.'],
            ['Discussion', 'Espace libre pour échanger autour du jeu et de ses émotions.'],
            ['Suggestions & Améliorations', 'Propositions pour faire évoluer le projet et affiner le gameplay.'],
            ['Sanctuaire du Code', 'Espace technique : bugs, moteur, alpha/bêta et retours devs.'],
        ];

        // Types disponibles pour les sections
        $types = ['announcement', 'info', 'discussion'];

        foreach ($sections as [$title, $desc]) {
            $section = new ForumSection();
            $section->setTitle($title);
            $section->setSlug($this->slugger->slug($title)->lower());
            $section->setDescription($desc);
            $section->setType($types[array_rand($types)]);
            $section->setIsActive(true);
            $section->setIsVisible(true);
            $section->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($section);
        }

        $manager->flush();
    }
}