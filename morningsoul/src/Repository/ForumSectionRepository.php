<?php

namespace App\Repository;

use App\Entity\ForumSection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ForumSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumSection::class);
    }

    // Retourne toutes les sections actives (où isActive = true), avec leurs topics et auteurs 
    public function findActiveSections(): array
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.topics', 't')
            ->addSelect('t')
            ->leftJoin('t.author', 'a')      
            ->addSelect('a')                   
            ->andWhere('s.isActive = :active')
            ->setParameter('active', true)
            ->orderBy('s.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}