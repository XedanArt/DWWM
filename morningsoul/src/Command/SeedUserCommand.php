<?php

// src/Command/SeedUserCommand.php
namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// php bin/console app:seed-user superadmin@superadmin.fr SuperAdmin WQA123XSZ987edc@ ROLE_SUPER_ADMIN
// php bin/console app:seed-user admin001@admin.fr Admin001 WQA123XSZ987edc@ ROLE_ADMIN
// php bin/console app:seed-user user001@user.fr User001 WQA123XSZ987edc@ ROLE_USER
#[AsCommand(name: 'app:seed-user')]
class SeedUserCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Crée un utilisateur en base sans formulaire')
            ->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('username', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
            ->addArgument('role', InputArgument::OPTIONAL, 'ROLE_USER');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $user->setEmail($input->getArgument('email'));
        $user->setUsername($input->getArgument('username'));
        $user->setPassword($this->hasher->hashPassword($user, $input->getArgument('password')));
        $user->setRoles([$input->getArgument('role')]);
        $user->setAvatar('default-avatar.png');
        $user->setBio('Utilisateur généré via seed.');

        $this->em->persist($user);
        $this->em->flush();

        $output->writeln('✅ Utilisateur créé : ' . $user->getDisplayUsername());
        return Command::SUCCESS;
    }
}