<?php

namespace App\Dto\Tmdb\Clients\FindApi;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use App\Dto\Tmdb\Responses\Find\FindById;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
readonly class FindApiClient implements FindApiInterface
{
    public function __construct(
        private HttpClientInterface $tmdbHttpClient,
        private DenormalizerInterface $denormalizer,
        private CacheInterface $redis,
    )
    {
    }

    /**
     * /3/find/{external_id} - Find data by external ID's.
     */
    public function findById(string $externalSource, string $externalId, ?string $language = null): FindById
    {
        $url = strtr('/3/find/{external_id}', [
            '{external_id}' => $externalId,
        ]);
        $query = [
            'external_source' => $externalSource,
            'language' => $language,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), FindById::class);
        });
    }
}