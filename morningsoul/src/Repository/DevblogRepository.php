<?php

namespace App\Repository;

use App\Entity\Devblog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Devblog>
 */
class DevblogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Devblog::class);
    }

    public function findPublished(): array
    {
        return $this->createQueryBuilder('d')
            ->where('d.date <= :now')
            ->setParameter('now', new \DateTimeImmutable())
            ->orderBy('d.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Devblog[] Returns an array of Devblog objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Devblog
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
