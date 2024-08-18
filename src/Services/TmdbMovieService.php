<?php

namespace App\Services;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Services\Interface\TmdbMovieInterface;
use Doctrine\ORM\EntityManagerInterface;
use Locale;
use Tmdb\Client;

readonly class TmdbMovieService implements TmdbMovieInterface
{
    public function __construct(
        private Client $tmdbClient,
        private MovieRepository $movieRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function findTmdbDetailsData(int $tmdbId, string $locale): array
    {
        $movie = $this->movieRepository->findOneBy(['tmdbId' => $tmdbId]);

        $data = $movie?->getTmdbDataForLocale($locale)?->getTmdbDetailsData();

        if (empty($data)) {
            $data = $this->tmdbClient->getMoviesApi()->getMovie($tmdbId, ['language' => $locale]);
        }

        if (null === $movie) {
            $movie = (new Movie())->setTmdbId($tmdbId);
            $this->entityManager->persist($movie);
            $this->entityManager->flush();
        }

        return $data;
    }

    /**
     * @return array{
     *     link: ?string,
     *     buy: array<string, mixed>,
     *     flatrate: array<string, mixed>,
     *     rent: array<string, mixed>,
     * }
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function findWatchProviders(int $tmdbId, string $locale): array
    {
        $regionKey = Locale::getRegion($locale) ?? 'US';
        $response = $this->tmdbClient->getMoviesApi()->getWatchProviders($tmdbId);
        $providers = [
            'link' => null,
            'buy' => [],
            'flatrate' => [],
            'rent' => [],
        ];
        if (!empty($response['results']) && array_key_exists($regionKey, $response['results'])) {
            $providers = array_merge($providers, $response['results'][$regionKey]);
        }

        return $providers;
    }
}
