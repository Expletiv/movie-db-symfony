<?php

namespace App\Services;

use App\Entity\Movie;
use App\Entity\MovieWatchlist;
use App\Repository\MovieRepository;
use App\Services\Interface\WatchlistInterface;
use Doctrine\ORM\EntityManagerInterface;

readonly class WatchlistService implements WatchlistInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MovieRepository $movieRepository,
    ) {
    }

    /**
     * @param MovieWatchlist[] $watchlists
     */
    public function addMovieToWatchlists(int $tmdbId, iterable $watchlists): void
    {
        $movie = $this->movieRepository->findOneBy(['tmdbId' => $tmdbId]);
        if (null === $movie) {
            $movie = (new Movie())->setTmdbId($tmdbId);
        }
        foreach ($watchlists as $watchlist) {
            $movie->addToWatchlist($watchlist);
        }
        $this->entityManager->flush();
    }
}
