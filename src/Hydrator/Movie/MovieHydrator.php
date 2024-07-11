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

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function hydrate(Movie $movie): Movie
    {
        try {
            $tmdbDetailsData = $this->tmdbClient->getMoviesApi()->getMovie($movie->getTmdbId());
            $movie->setTmdbDetailsData($tmdbDetailsData);
            $movie->setTitle($tmdbDetailsData['title']);
            $movie->setPopularity($tmdbDetailsData['popularity']);
            $releaseDate = \DateTimeImmutable::createFromFormat('Y-m-d', $tmdbDetailsData['release_date']);
            if (!$releaseDate) {
                $this->logger->error(sprintf('could not parse release date %s with format Y-m-d', $tmdbDetailsData['release_date']));
            }
            $movie->setReleaseDate($releaseDate);
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
