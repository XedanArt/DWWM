<?php

namespace App\Repository;

use App\Entity\Changelog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ChangelogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Changelog::class);
    }

    public function findPublished(): array
    { 
        return $this->createQueryBuilder('c')
            ->andWhere('c.date <= :now')
            ->setParameter('now', new \DateTimeImmutable())
            ->orderBy('c.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

}
