<?php

namespace App\Services;

use App\Dto\Tmdb\Responses\Movie\MovieDetails;
use App\Dto\Tmdb\TmdbClientInterface;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Services\Interface\TmdbMovieInterface;
use Doctrine\ORM\EntityManagerInterface;
use Locale;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

readonly class TmdbMovieService implements TmdbMovieInterface
{
    public function __construct(
        private MovieRepository $movieRepository,
        private EntityManagerInterface $entityManager,
        private TmdbClientInterface $tmdb,
        private DenormalizerInterface $denormalizer,
    ) {
    }

    public function findTmdbDetailsData(int $tmdbId, string $locale): MovieDetails
    {
        $movie = $this->movieRepository->findOneBy(['tmdbId' => $tmdbId]);

        $data = $movie?->getTmdbDataForLocale($locale)?->getTmdbDetailsData();

        $data = empty($data)
            ? $this->tmdb->movieApi()->movieDetails($tmdbId, language: $locale)
            : $this->denormalizer->denormalize($data, MovieDetails::class);

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
     *     buy: mixed,
     *     flatrate: mixed,
     *     rent: mixed,
     * }
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function findWatchProviders(int $tmdbId, string $locale): array
    {
        $regionKey = Locale::getRegion($locale) ?? 'US';

        $watchProviders = $this->tmdb->movieApi()->movieWatchProviders($tmdbId);
        $propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()
            ->disableExceptionOnInvalidPropertyPath()
            ->getPropertyAccessor();

        return [
            'link' => $propertyAccessor->getValue($watchProviders, 'results?.'.$regionKey.'?.link'),
            'buy' => $propertyAccessor->getValue($watchProviders, 'results?.'.$regionKey.'?.buy') ?? [],
            'flatrate' => $propertyAccessor->getValue($watchProviders, 'results?.'.$regionKey.'?.flatrate') ?? [],
            'rent' => $propertyAccessor->getValue($watchProviders, 'results?.'.$regionKey.'?.rent') ?? [],
        ];
    }
}
