<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// php bin/console app:promote-super-admin superadmin@superadmin.fr
#[AsCommand(
    name: 'app:promote-super-admin',
    description: 'Attribue le rôle ROLE_SUPER_ADMIN à un utilisateur existant.',
)]
class PromoteSuperAdminCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Email de l’utilisateur à promouvoir');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument('email');
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user) {
            $output->writeln("<error>Utilisateur avec l'email '$email' introuvable.</error>");
            return Command::FAILURE;
        }

        $roles = $user->getRoles();
        if (!in_array('ROLE_SUPER_ADMIN', $roles)) {
            $roles[] = 'ROLE_SUPER_ADMIN';
            $user->setRoles($roles);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $output->writeln("<info> Utilisateur '$email' promu en super admin.</info>");
        } else {
            $output->writeln("<comment> L'utilisateur '$email' est déjà super admin.</comment>");
        }

        return Command::SUCCESS;
    }
}