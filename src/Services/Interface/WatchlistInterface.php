<?php

namespace App\Services\Interface;

use App\Entity\MovieWatchlist;

interface WatchlistInterface
{
    /**
     * Adds a movie to all the given watchlists.
     *
     * @param MovieWatchlist[] $watchlists
     */
    public function addMovieToWatchlists(int $tmdbId, iterable $watchlists): void;
}
