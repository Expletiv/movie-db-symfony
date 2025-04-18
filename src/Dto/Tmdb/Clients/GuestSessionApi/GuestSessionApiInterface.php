<?php

namespace App\Dto\Tmdb\Clients\GuestSessionApi;

use App\Dto\Tmdb\Responses\GuestSession\GuestSessionRatedMovies;
use App\Dto\Tmdb\Responses\GuestSession\GuestSessionRatedTv;
use App\Dto\Tmdb\Responses\GuestSession\GuestSessionRatedTvEpisodes;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
interface GuestSessionApiInterface
{
    /**
     * /3/guest_session/{guest_session_id}/rated/movies - Get the rated movies for a guest session.
     */
    public function guestSessionRatedMovies(string $guestSessionId, ?string $sortBy = 'created_at.asc', ?int $page = 1, ?string $language = 'en-US'): GuestSessionRatedMovies;

    /**
     * /3/guest_session/{guest_session_id}/rated/tv - Get the rated TV shows for a guest session.
     */
    public function guestSessionRatedTv(string $guestSessionId, ?string $sortBy = 'created_at.asc', ?int $page = 1, ?string $language = 'en-US'): GuestSessionRatedTv;

    /**
     * /3/guest_session/{guest_session_id}/rated/tv/episodes - Get the rated TV episodes for a guest session.
     */
    public function guestSessionRatedTvEpisodes(string $guestSessionId, ?string $sortBy = 'created_at.asc', ?int $page = 1, ?string $language = 'en-US'): GuestSessionRatedTvEpisodes;
}