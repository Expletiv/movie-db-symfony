<?php

namespace App\Dto\Tmdb\Clients\PersonApi;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use App\Dto\Tmdb\Responses\Person\PersonDetails;
use App\Dto\Tmdb\Responses\Person\PersonChanges;
use App\Dto\Tmdb\Responses\Person\PersonImages;
use App\Dto\Tmdb\Responses\Person\PersonMovieCredits;
use App\Dto\Tmdb\Responses\Person\PersonTvCredits;
use App\Dto\Tmdb\Responses\Person\PersonCombinedCredits;
use App\Dto\Tmdb\Responses\Person\PersonExternalIds;
use App\Dto\Tmdb\Responses\Person\PersonTaggedImages;
use App\Dto\Tmdb\Responses\Person\Translations;
use App\Dto\Tmdb\Responses\Person\PersonPopularList;
use App\Dto\Tmdb\Responses\Person\ChangesPeopleList;
use App\Dto\Tmdb\Responses\Person\PersonLatestId;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
readonly class PersonApiClient implements PersonApiInterface
{
    public function __construct(
        private HttpClientInterface $tmdbHttpClient,
        private DenormalizerInterface $denormalizer,
        private CacheInterface $redis,
    )
    {
    }

    /**
     * /3/person/{person_id} - Query the top level details of a person.
     * @param ?string $appendToResponse comma separated list of endpoints within this namespace, 20 items max
     */
    public function personDetails(int $personId, ?string $language = 'en-US', ?string $appendToResponse = null): PersonDetails
    {
        $url = strtr('/3/person/{person_id}', [
            '{person_id}' => $personId,
        ]);
        $query = [
            'append_to_response' => $appendToResponse,
            'language' => $language,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), PersonDetails::class);
        });
    }

    /**
     * /3/person/{person_id}/changes - Get the recent changes for a person.
     */
    public function personChanges(int $personId, ?string $startDate = null, ?int $page = 1, ?string $endDate = null): PersonChanges
    {
        $url = strtr('/3/person/{person_id}/changes', [
            '{person_id}' => $personId,
        ]);
        $query = [
            'end_date' => $endDate,
            'page' => $page,
            'start_date' => $startDate,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), PersonChanges::class);
        });
    }

    /**
     * /3/person/{person_id}/images - Get the profile images that belong to a person.
     */
    public function personImages(int $personId): PersonImages
    {
        $url = strtr('/3/person/{person_id}/images', [
            '{person_id}' => $personId,
        ]);
        $query = [
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), PersonImages::class);
        });
    }

    /**
     * /3/person/{person_id}/movie_credits - Get the movie credits for a person.
     */
    public function personMovieCredits(int $personId, ?string $language = 'en-US'): PersonMovieCredits
    {
        $url = strtr('/3/person/{person_id}/movie_credits', [
            '{person_id}' => $personId,
        ]);
        $query = [
            'language' => $language,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), PersonMovieCredits::class);
        });
    }

    /**
     * /3/person/{person_id}/tv_credits - Get the TV credits that belong to a person.
     */
    public function personTvCredits(int $personId, ?string $language = 'en-US'): PersonTvCredits
    {
        $url = strtr('/3/person/{person_id}/tv_credits', [
            '{person_id}' => $personId,
        ]);
        $query = [
            'language' => $language,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), PersonTvCredits::class);
        });
    }

    /**
     * /3/person/{person_id}/combined_credits - Get the combined movie and TV credits that belong to a person.
     */
    public function personCombinedCredits(string $personId, ?string $language = 'en-US'): PersonCombinedCredits
    {
        $url = strtr('/3/person/{person_id}/combined_credits', [
            '{person_id}' => $personId,
        ]);
        $query = [
            'language' => $language,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), PersonCombinedCredits::class);
        });
    }

    /**
     * /3/person/{person_id}/external_ids - Get the external ID's that belong to a person.
     */
    public function personExternalIds(int $personId): PersonExternalIds
    {
        $url = strtr('/3/person/{person_id}/external_ids', [
            '{person_id}' => $personId,
        ]);
        $query = [
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), PersonExternalIds::class);
        });
    }

    /**
     * /3/person/{person_id}/tagged_images - Get the tagged images for a person.
     */
    public function personTaggedImages(int $personId, ?int $page = 1): PersonTaggedImages
    {
        $url = strtr('/3/person/{person_id}/tagged_images', [
            '{person_id}' => $personId,
        ]);
        $query = [
            'page' => $page,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), PersonTaggedImages::class);
        });
    }

    /**
     * /3/person/{person_id}/translations - Get the translations that belong to a person.
     */
    public function translations(int $personId): Translations
    {
        $url = strtr('/3/person/{person_id}/translations', [
            '{person_id}' => $personId,
        ]);
        $query = [
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), Translations::class);
        });
    }

    /**
     * /3/person/popular - Get a list of people ordered by popularity.
     */
    public function personPopularList(?int $page = 1, ?string $language = 'en-US'): PersonPopularList
    {
        $url = strtr('/3/person/popular', [
        ]);
        $query = [
            'language' => $language,
            'page' => $page,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), PersonPopularList::class);
        });
    }

    /**
     * /3/person/changes
     */
    public function changesPeopleList(?int $page = 1, ?string $startDate = null, ?string $endDate = null): ChangesPeopleList
    {
        $url = strtr('/3/person/changes', [
        ]);
        $query = [
            'end_date' => $endDate,
            'page' => $page,
            'start_date' => $startDate,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), ChangesPeopleList::class);
        });
    }

    /**
     * /3/person/latest - Get the newest created person. This is a live response and will continuously change.
     */
    public function personLatestId(): PersonLatestId
    {
        $url = strtr('/3/person/latest', [
        ]);
        $query = [
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), PersonLatestId::class);
        });
    }
}