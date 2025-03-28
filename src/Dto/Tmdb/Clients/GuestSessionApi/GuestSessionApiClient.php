<?php

namespace App\Dto\Tmdb\Clients\GuestSessionApi;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use App\Dto\Tmdb\Responses\GuestSession\GuestSessionRatedMovies;
use App\Dto\Tmdb\Responses\GuestSession\GuestSessionRatedTv;
use App\Dto\Tmdb\Responses\GuestSession\GuestSessionRatedTvEpisodes;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
readonly class GuestSessionApiClient implements GuestSessionApiInterface
{
    public function __construct(
        private HttpClientInterface $tmdbHttpClient,
        private DenormalizerInterface $denormalizer,
        private CacheInterface $redis,
    )
    {
    }

    /**
     * /3/guest_session/{guest_session_id}/rated/movies - Get the rated movies for a guest session.
     */
    public function guestSessionRatedMovies(string $guestSessionId, ?string $sortBy = 'created_at.asc', ?int $page = 1, ?string $language = 'en-US'): GuestSessionRatedMovies
    {
        $url = strtr('/3/guest_session/{guest_session_id}/rated/movies', [
            '{guest_session_id}' => $guestSessionId,
        ]);
        $query = [
            'language' => $language,
            'page' => $page,
            'sort_by' => $sortBy,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), GuestSessionRatedMovies::class);
        });
    }

    /**
     * /3/guest_session/{guest_session_id}/rated/tv - Get the rated TV shows for a guest session.
     */
    public function guestSessionRatedTv(string $guestSessionId, ?string $sortBy = 'created_at.asc', ?int $page = 1, ?string $language = 'en-US'): GuestSessionRatedTv
    {
        $url = strtr('/3/guest_session/{guest_session_id}/rated/tv', [
            '{guest_session_id}' => $guestSessionId,
        ]);
        $query = [
            'language' => $language,
            'page' => $page,
            'sort_by' => $sortBy,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), GuestSessionRatedTv::class);
        });
    }

    /**
     * /3/guest_session/{guest_session_id}/rated/tv/episodes - Get the rated TV episodes for a guest session.
     */
    public function guestSessionRatedTvEpisodes(string $guestSessionId, ?string $sortBy = 'created_at.asc', ?int $page = 1, ?string $language = 'en-US'): GuestSessionRatedTvEpisodes
    {
        $url = strtr('/3/guest_session/{guest_session_id}/rated/tv/episodes', [
            '{guest_session_id}' => $guestSessionId,
        ]);
        $query = [
            'language' => $language,
            'page' => $page,
            'sort_by' => $sortBy,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), GuestSessionRatedTvEpisodes::class);
        });
    }
}