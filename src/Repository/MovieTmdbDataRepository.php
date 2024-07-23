<?php

namespace App\Repository;

use App\Entity\MovieTmdbData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\ParameterType;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MovieTmdbData>
 */
class MovieTmdbDataRepository extends ServiceEntityRepository
{
    public const int PAGE_SIZE = 20;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieTmdbData::class);
    }

    /**
     * @return MovieTmdbData[]
     */
    public function findMoviesWhereLocalesAreMissing(): array
    {
        $subquery = $this->createQueryBuilder('mv')
            ->select('mv.movie')
            ->groupBy('mv.movie')
            ->having('COUNT(mv.locale) = 1');

        $qb = $this->createQueryBuilder('m');
        $qb->where($qb->expr()->in(
            'm.movie',
            $subquery->getDQL()
        ));

        return $qb->getQuery()->getResult();
    }

    /**
     * @return MovieTmdbData[]
     */
    public function findPageOrderedByPopularity(int $page = 1, string $locale = 'en'): array
    {
        $offset = ($page - 1) * self::PAGE_SIZE;

        $qb = $this->createQueryBuilder('d')
            ->join('d.movie', 'm')
            ->orderBy('m.popularity', 'DESC')
            ->where('d.locale = :locale')
            ->setFirstResult($offset)
            ->setMaxResults(self::PAGE_SIZE)
            ->setParameter('locale', $locale, ParameterType::STRING);

        return $qb->getQuery()->getResult();
    }

    public function getMaxPage(string $locale = 'en'): int
    {
        /** @var int $count */
        $count = $this->createQueryBuilder('d')
            ->where('d.locale = :locale')
            ->select('COUNT(d.id)')
            ->setParameter('locale', $locale, ParameterType::STRING)
            ->getQuery()
            ->getSingleScalarResult();

        return (int) ceil($count / self::PAGE_SIZE);
    }
}
