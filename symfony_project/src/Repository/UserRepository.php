<?php
namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllWithRelations(): array
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.topics', 't')
            ->addSelect('t')
            ->leftJoin('u.posts', 'p')
            ->addSelect('p')
            ->orderBy('u.username', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findAdmins(): array
    {
        return $this->createQueryBuilder('u')
        ->where('JSON_CONTAINS(u.roles, :role) = 1')
        ->setParameter('role', json_encode('ROLE_ADMIN'))
        ->orderBy('u.username', 'ASC')
        ->getQuery()
        ->getResult();
    }

    public function findPendingInvitations(): array
    {
        return $this->createQueryBuilder('u')
            ->where('u.resetToken IS NOT NULL')
            ->andWhere('u.tokenExpiresAt > :now')
            ->setParameter('now', new \DateTime())
            ->getQuery()
            ->getResult();
    }

}
