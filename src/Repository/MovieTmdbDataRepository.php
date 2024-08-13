<?php

namespace App\Repository;

use App\Entity\MovieTmdbData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

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
    public function findPageOrderedByPopularity(int $page = 1, string $locale = 'en'): array
    {
        $qb = $this->queryForPageWithLocale($page, $locale)
            ->join('d.movie', 'm')
            ->orderBy('m.popularity', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function getMaxPage(string $locale): int
    {
        return $this->getMaxPageForQuery($this->queryForLocale($locale));
    }

    /**
     * @return MovieTmdbData[]
     */
    public function findWatchlistMovies(Uuid $watchlistId, int $page, string $locale): array
    {
        $qb = $this->joinWithWatchlist($this->queryForPageWithLocale($page, $locale), $watchlistId);

        return $qb->getQuery()->getResult();
    }

    public function getMaxWatchlistPage(Uuid $watchlistId, string $locale): int
    {
        $qb = $this->joinWithWatchlist($this->queryForLocale($locale), $watchlistId);

        return $this->getMaxPageForQuery($qb);
    }

    private function getMaxPageForQuery(QueryBuilder $qb): int
    {
        /** @var int $count */
        $count = $qb
            ->select('COUNT(d.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return max((int) ceil($count / self::PAGE_SIZE), 1);
    }

    private function queryForLocale(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.locale = :locale')
            ->setParameter('locale', $locale, ParameterType::STRING);
    }

    private function queryForPageWithLocale(int $page, string $locale): QueryBuilder
    {
        $offset = ($page - 1) * self::PAGE_SIZE;

        return $this->queryForLocale($locale)
            ->setFirstResult($offset)
            ->setMaxResults(self::PAGE_SIZE);
    }

    private function joinWithWatchlist(QueryBuilder $qb, Uuid $watchlistId): QueryBuilder
    {
        return $qb
            ->join('d.movie', 'm')
            ->leftJoin('m.watchlists', 'w')
            ->andWhere('w.id = :watchlistId')
            ->setParameter('watchlistId', $watchlistId, UuidType::NAME);
    }
}
