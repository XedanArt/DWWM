<?php

namespace App\Command;

use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:seed-tags')]
class SeedTagsCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $names = ['MorningSoul', 'Information', 'Help', 'Character', 'Weapon', 'Tutorial', 'Mob', 'Boss', 'Bug', 'Support'];

        $existing = $this->em->getRepository(Tag::class)->createQueryBuilder('t')
            ->select('t.name')
            ->getQuery()
            ->getArrayResult();

        $existingNames = array_map(fn($row) => $row['name'], $existing);

        foreach ($names as $name) {
            if (in_array($name, $existingNames, true)) {
                $output->writeln("Tag déjà présent : $name");
                continue;
            }

            $tag = new Tag();
            $tag->setName($name);
            $this->em->persist($tag);
            $output->writeln("Tag ajouté : $name");
        }

        $this->em->flush();
        $output->writeln('✅ Tags injectés avec succès.');
        return Command::SUCCESS;
    }
}