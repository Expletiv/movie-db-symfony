<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Movie>
 */
class MovieRepository extends ServiceEntityRepository
{
    public const int PAGE_SIZE = 20;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    /**
     * @return Movie[]
     */
    public function findPageOrderedByPopularity(int $page = 1): array
    {
        $offset = ($page - 1) * self::PAGE_SIZE;

        $qb = $this->createQueryBuilder('m')
            ->orderBy('m.popularity', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults(self::PAGE_SIZE);

        return $qb->getQuery()->getResult();
    }
}
