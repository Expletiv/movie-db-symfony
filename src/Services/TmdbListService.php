<?php

namespace App\Services;

use App\Services\Interface\TmdbListInterface;
use Tmdb\Client;

readonly class TmdbListService implements TmdbListInterface
{
    public function __construct(
        private Client $tmdbClient,
    ) {
    }

    public function popularMovies(array $parameters = [], array $headers = []): array
    {
        return $this->tmdbClient->getMoviesApi()->getPopular($parameters, $headers);
    }

    public function discoverMovies(array $parameters = [], array $headers = []): array
    {
        return $this->tmdbClient->getDiscoverApi()->discoverMovies($parameters, $headers);
    }

    public function topRatedMovies(array $parameters = [], array $headers = []): array
    {
        return $this->tmdbClient->getMoviesApi()->getTopRated($parameters, $headers);
    }

    public function searchMovies(string $query, array $parameters = [], array $headers = []): array
    {
        return $this->tmdbClient->getSearchApi()->searchMovies($query, $parameters, $headers);
    }

    public function recommendedMovies(int $tmdbId, array $parameters = [], array $headers = []): array
    {
        return $this->tmdbClient->getMoviesApi()->getRecommendations($tmdbId, $parameters, $headers);
    }
}
