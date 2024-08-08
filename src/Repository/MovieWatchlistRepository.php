<?php

namespace App\Repository;

use App\Entity\MovieWatchlist;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MovieWatchlist>
 */
class MovieWatchlistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieWatchlist::class);
    }

    /**
     * @return array<string, string>
     */
    public function findPosterPathsForUsersWatchlists(User $user, string $locale): array
    {
        // result is an array uuid => poster_path where each tuple is a pair
        // of watchlist and poster_path of the most popular movie with a poster

        /** @var array<string, string> $result */
        $result = $this->getEntityManager()->getConnection()->fetchAllKeyValue(
            <<<SQL
            SELECT DISTINCT ON (w.id) w.id, d.tmdb_details_data::jsonb->>'poster_path' FROM movie_watchlist w
                JOIN movie_watchlist_movie join_table ON w.id = join_table.movie_watchlist_id
                JOIN movie m ON m.id = join_table.movie_id
                JOIN movie_tmdb_data d ON m.id = d.movie_id
            WHERE w.owner_id = :owner
            AND d.locale = :locale
            AND tmdb_details_data::jsonb->>'poster_path' IS NOT NULL
            ORDER BY w.id, m.popularity DESC
            SQL,
            ['owner' => $user->getId(), 'locale' => $locale],
        );

        return $result;
    }
}
