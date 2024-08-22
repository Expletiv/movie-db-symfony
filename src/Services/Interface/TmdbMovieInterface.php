<?php

namespace App\Services\Interface;

use App\Dto\Tmdb\Responses\Movie\MovieDetails;

interface TmdbMovieInterface
{
    /**
     * Find TMDB details data for a given tmdbId and locale. The response is the json decoded response from the TMDB
     * API V3 endpoint /movie/{movie_id}.
     */
    public function findTmdbDetailsData(int $tmdbId, string $locale): MovieDetails;

    /**
     * Find the watch providers for a given tmdbId and locale. The response is the json decoded response from the TMDB
     * API V3 endpoint /movie/{movie_id}/watch/providers.
     *
     * @return array{
     *     link: ?string,
     *     buy: mixed,
     *     flatrate: mixed,
     *     rent: mixed,
     * }
     */
    public function findWatchProviders(int $tmdbId, string $locale): array;
}
