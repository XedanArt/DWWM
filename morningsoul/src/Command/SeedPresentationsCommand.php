<?php

namespace App\Command;

use App\Entity\Presentation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:seed-presentations',
    description: 'Insère les présentations par défaut en base de données.',
)]
class SeedPresentationsCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $presentations = [
            [
                'title' => 'Un univers sombre et complet',
                'description' => 'Plongez dans un monde où chaque décision est lourde de sens et chaque réussite arrachée à la difficulté. - Morning Soul - récompse l\'audace, la réflexion et la persévérance dans une avanteure intense et inoubliable.',
                'background' => 'hero-1',
            ],
            [
                'title' => 'Gameplay exigeant mais gratifiant',
                'description' => 'Un RPG aux mécaniques originales, dans lequel chaque affrontement met vos choix à l\'épreuve. Le système de classes offre une richesse rare : créez, combinez et adaptez votre style à travers des configurations variées.',
                'background' => 'hero-2',
            ],
            [
                'title' => 'Un monde en constante evolution',
                'description' => '- Morning Soul - est un projet vivant. En perpétuelle expansion, il évolue au fil des idées, des inspirations et des retours de la communauté. Entre mises à jour, équilibrages et extensions narratives, ce monde s’étoffe avec une ambition sincère : créer une expérience marquante et durable.',
                'background' => 'hero-3',
            ],
        ];

        $repo = $this->em->getRepository(Presentation::class);

        foreach ($presentations as $data) {
            $existing = $repo->findOneBy(['title' => $data['title']]);

            if ($existing) {
                $output->writeln("⏩ Présentation déjà présente : <info>{$data['title']}</info>");
                continue;
            }

            $presentation = new Presentation();
            $presentation
                ->setTitle($data['title'])
                ->setDescription($data['description'])
                ->setBackground($data['background']);

            $this->em->persist($presentation);
            $output->writeln("✅ Présentation insérée : <comment>{$data['title']}</comment>");
        }

        $this->em->flush();
        $output->writeln('<fg=green>✔ Toutes les présentations ont été traitées.</>');

        return Command::SUCCESS;
    }
}