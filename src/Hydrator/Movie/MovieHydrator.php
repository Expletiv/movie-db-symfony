<?php

namespace App\Hydrator\Movie;

use App\Entity\Movie;
use App\Entity\MovieTmdbData;
use DateTimeImmutable;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Tmdb\Client;
use Tmdb\Exception\TmdbApiException;

readonly class MovieHydrator
{
    public function __construct(
        private Client $tmdbClient,
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
                $tmdbDetailsData = $this->tmdbClient->getMoviesApi()->getMovie($movie->getTmdbId(), ['language' => $tmdbData->getLocale()]);
                $tmdbData->setTmdbDetailsData($tmdbDetailsData);
                $tmdbData->setTitle($tmdbDetailsData['title']);

                $movie->setTitle($tmdbDetailsData['original_title']);
                $movie->setPopularity($tmdbDetailsData['popularity']);
                $releaseDate = DateTimeImmutable::createFromFormat('Y-m-d', $tmdbDetailsData['release_date']);
                if (!$releaseDate) {
                    $this->logger->error(sprintf('could not parse release date %s with format Y-m-d', $tmdbDetailsData['release_date']));
                }
                $movie->setReleaseDate($releaseDate);
            } catch (TmdbApiException $e) {
                $this->logger->error(sprintf(
                    'unable to fetch tmdb data for id %s, error message: %s',
                    $movie->getTmdbId(),
                    $e->getMessage(),
                ), ['exception' => $e]);
            }
        }
    }
}
