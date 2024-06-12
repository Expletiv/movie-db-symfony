<?php

namespace App\Hydrator\Movie;

use App\Entity\Movie;
use Psr\Log\LoggerInterface;
use Tmdb\Client;
use Tmdb\Exception\TmdbApiException;

readonly class MovieHydrator
{
    public function __construct(
        private Client $tmdbClient,
        private LoggerInterface $logger,
    ) {
    }

    public function hydrate(Movie $movie): Movie
    {
        try {
            $tmdbDetailsData = $this->tmdbClient->getMoviesApi()->getMovie($movie->getTmdbId());
            $movie->setTmdbDetailsData($tmdbDetailsData);
        } catch (TmdbApiException $e) {
            $this->logger->error(sprintf(
                'unable to fetch tmdb data for id %s, error message: %s',
                $movie->getTmdbId(),
                $e->getMessage(),
            ), ['exception' => $e]);
        }

        return $movie;
    }
}
