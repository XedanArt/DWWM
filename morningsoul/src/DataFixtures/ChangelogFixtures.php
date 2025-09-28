<?php

namespace App\DataFixtures;

use App\Entity\Changelog;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Cocur\Slugify\Slugify;

class ChangelogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $slugify = new Slugify();

        $changelog = new Changelog();
        $changelog->setVersion('1.0');
        $changelog->setDate(new \DateTime('2025-09-07'));
        $changelog->setContent("Ajout : système de craft\nCorrection : bug d'affichage dans l'inventaire");
        $changelog->setImage('changelog_01.png');
        $changelog->setSlug($slugify->slugify('Version 1.0'));

        $manager->persist($changelog);
        $manager->flush();
    }
}