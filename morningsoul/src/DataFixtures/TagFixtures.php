<?php

// src/DataFixtures/TagFixtures.php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = ['Mystique', 'Aube', 'Souvenir', 'Éclipse', 'Rêverie', 'Oubli', 'Lumière', 'Silence', 'Nuit', 'Éveil', 'Test'];

        foreach ($names as $name) {
            $tag = new Tag();
            $tag->setName($name);
            $manager->persist($tag);
        }

        $manager->flush();
    }
}