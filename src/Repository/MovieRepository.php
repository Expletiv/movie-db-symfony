<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\ParameterType;
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
    public function findMoviesWhereLocalesAreMissing(): array
    {
        $subquery = $this->createQueryBuilder('mv')
            ->select('mv.tmdbId')
            ->groupBy('mv.tmdbId')
            ->having('COUNT(mv.locale) = 1');

        $qb = $this->createQueryBuilder('m');
        $qb->where($qb->expr()->in(
            'm.tmdbId',
            $subquery->getDQL()
        ));

        return $qb->getQuery()->getResult();
    }

    /**
     * @return Movie[]
     */
    public function findPageOrderedByPopularity(int $page = 1, string $locale = 'en'): array
    {
        $offset = ($page - 1) * self::PAGE_SIZE;

        $qb = $this->createQueryBuilder('m')
            ->orderBy('m.popularity', 'DESC')
            ->where('m.locale = :locale')
            ->setFirstResult($offset)
            ->setMaxResults(self::PAGE_SIZE)
            ->setParameter('locale', $locale, ParameterType::STRING);

        return $qb->getQuery()->getResult();
    }

    public function getMaxPage(string $locale = 'en'): int
    {
        /** @var int $count */
        $count = $this->createQueryBuilder('m')
            ->where('m.locale = :locale')
            ->select('COUNT(m.id)')
            ->setParameter('locale', $locale, ParameterType::STRING)
            ->getQuery()
            ->getSingleScalarResult();

        return (int) ceil($count / self::PAGE_SIZE);
    }
}
