<?php

namespace App\Dto\Tmdb\Clients\ConfigurationApi;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use App\Dto\Tmdb\Responses\Configuration\ConfigurationDetails;
use App\Dto\Tmdb\Responses\Configuration\ConfigurationCountries;
use App\Dto\Tmdb\Responses\Configuration\ConfigurationJobs;
use App\Dto\Tmdb\Responses\Configuration\ConfigurationLanguages;
use App\Dto\Tmdb\Responses\Configuration\ConfigurationTimezones;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
readonly class ConfigurationApiClient implements ConfigurationApiInterface
{
    public function __construct(
        private HttpClientInterface $tmdbHttpClient,
        private DenormalizerInterface $denormalizer,
        private CacheInterface $redis,
    )
    {
    }

    /**
     * /3/configuration - Query the API configuration details.
     */
    public function configurationDetails(): ConfigurationDetails
    {
        $url = strtr('/3/configuration', [
        ]);
        $query = [
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), ConfigurationDetails::class);
        });
    }

    /**
     * /3/configuration/countries - Get the list of countries (ISO 3166-1 tags) used throughout TMDB.
     * @return array<ConfigurationCountries>
     */
    public function configurationCountries(?string $language = 'en-US'): array
    {
        $url = strtr('/3/configuration/countries', [
        ]);
        $query = [
            'language' => $language,
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), ConfigurationCountries::class . '[]');
        });
    }

    /**
     * /3/configuration/jobs - Get the list of the jobs and departments we use on TMDB.
     * @return array<ConfigurationJobs>
     */
    public function configurationJobs(): array
    {
        $url = strtr('/3/configuration/jobs', [
        ]);
        $query = [
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), ConfigurationJobs::class . '[]');
        });
    }

    /**
     * /3/configuration/languages - Get the list of languages (ISO 639-1 tags) used throughout TMDB.
     * @return array<ConfigurationLanguages>
     */
    public function configurationLanguages(): array
    {
        $url = strtr('/3/configuration/languages', [
        ]);
        $query = [
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), ConfigurationLanguages::class . '[]');
        });
    }

    /**
     * /3/configuration/primary_translations - Get a list of the officially supported translations on TMDB.
     * @return array<string>
     */
    public function configurationPrimaryTranslations(): array
    {
        $url = strtr('/3/configuration/primary_translations', [
        ]);
        $query = [
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $response->toArray();
        });
    }

    /**
     * /3/configuration/timezones - Get the list of timezones used throughout TMDB.
     * @return array<ConfigurationTimezones>
     */
    public function configurationTimezones(): array
    {
        $url = strtr('/3/configuration/timezones', [
        ]);
        $query = [
        ];

        $cacheKey = md5($url.'?'.http_build_query($query));
        return $this->redis->get($cacheKey, function ($item) use ($url, $query) {
            $item->expiresAfter(10800);
            $response = $this->tmdbHttpClient->request('GET', $url, ['query' => $query]);
            return $this->denormalizer->denormalize($response->toArray(), ConfigurationTimezones::class . '[]');
        });
    }
}