<?php

namespace App\Hydrator\Movie;

use App\Dto\Tmdb\TmdbClientInterface;
use App\Entity\Movie;
use App\Entity\MovieTmdbData;
use DateTimeImmutable;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Throwable;

readonly class MovieHydrator
{
    public function __construct(
        private TmdbClientInterface $tmdbClient,
        private LoggerInterface $logger,
        /**
         * @var string[]
         */
        #[Autowire(param: 'kernel.enabled_locales')]
        private array $enabledLocales,
    ) {
    }

    public function hydrateWithEnabledLocales(Movie $movie): Movie
    {
        foreach ($this->enabledLocales as $locale) {
            $tmdbData = (new MovieTmdbData())->setLocale($locale);
            $movie->addTmdbDatum($tmdbData);
        }

        $this->hydrate($movie);

        return $movie;
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function hydrate(Movie $movie): void
    {
        foreach ($movie->getTmdbData() as $tmdbData) {
            try {
                $movieDetails = $this->tmdbClient->movieApi()
                    ->movieDetails(movieId: $movie->getTmdbId(), language: $tmdbData->getLocale());

                $tmdbData->setTmdbDetailsData($movieDetails->toArray());
                $tmdbData->setTitle($movieDetails->getTitle() ?? '');

                $movie->setTitle($movieDetails->getOriginalTitle() ?? '');
                $movie->setPopularity($movieDetails->getPopularity() ?? 0);
                $releaseDate = DateTimeImmutable::createFromFormat('Y-m-d', $movieDetails->getReleaseDate() ?? '');
                if (false === $releaseDate) {
                    $this->logger->error(sprintf('could not parse release date %s with format Y-m-d', $movieDetails->getReleaseDate() ?? ''));
                }
                $movie->setReleaseDate($releaseDate);
            } catch (Throwable $e) {
                $this->logger->error(sprintf(
                    'unable to fetch tmdb data for id %s, error message: %s',
                    $movie->getTmdbId(),
                    $e->getMessage(),
                ), ['exception' => $e]);
            }
        }
    }
}
