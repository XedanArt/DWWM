<?php

namespace App\Repository;

use App\Entity\Topic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;



class TopicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Topic::class);
    }

    public function findLatest(int $limit = 5): array
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findBySection(int $sectionId): array
    {
        return $this->createQueryBuilder('t')
            ->join('t.section', 's')
            ->andWhere('s.id = :id')
            ->setParameter('id', $sectionId)
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findWithPosts(int $id): ?Topic
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.posts', 'p')
            ->addSelect('p')
            ->leftJoin('p.user', 'u')
            ->addSelect('u')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByTag(Tag $tag): array
    {
        return $this->createQueryBuilder('t')
            ->join('t.tags', 'tag')
            ->where('tag = :tag')
            ->setParameter('tag', $tag)
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findFavoritesByUser(User $user): \Doctrine\ORM\QueryBuilder
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.favoritedBy', 'u') // Assure-toi que 'favoritedBy' est bien le nom de la relation ManyToMany dans Topic
            ->where('u = :user')
            ->setParameter('user', $user)
            ->orderBy('t.createdAt', 'DESC');
    }

}