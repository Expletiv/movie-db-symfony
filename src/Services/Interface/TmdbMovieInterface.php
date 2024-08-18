<?php

namespace App\Services\Interface;

interface TmdbMovieInterface
{
    /**
     * Find TMDB details data for a given tmdbId and locale. The response is the json decoded response from the TMDB
     * API V3 endpoint /movie/{movie_id}.
     *
     * @return array<string, mixed>
     */
    public function findTmdbDetailsData(int $tmdbId, string $locale): array;

    /**
     * Find the watch providers for a given tmdbId and locale. The response is the json decoded response from the TMDB
     * API V3 endpoint /movie/{movie_id}/watch/providers.
     *
     * @return array{
     *     link: ?string,
     *     buy: array<string, mixed>,
     *     flatrate: array<string, mixed>,
     *     rent: array<string, mixed>,
     * }
     */
    public function findWatchProviders(int $tmdbId, string $locale): array;
}
