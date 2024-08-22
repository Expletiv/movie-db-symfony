<?php

namespace App\Tests\Services;

use App\Dto\Tmdb\Clients\MovieApi\MovieApiInterface;
use App\Dto\Tmdb\Responses\Movie\MovieDetails;
use App\Dto\Tmdb\Responses\Movie\MovieWatchProviders;
use App\Dto\Tmdb\Responses\Movie\MovieWatchProvidersResults;
use App\Dto\Tmdb\Responses\Movie\MovieWatchProvidersResultsDE;
use App\Dto\Tmdb\Responses\Movie\MovieWatchProvidersResultsDERent;
use App\Dto\Tmdb\Responses\Movie\MovieWatchProvidersResultsUS;
use App\Dto\Tmdb\Responses\Movie\MovieWatchProvidersResultsUSBuy;
use App\Dto\Tmdb\Responses\Movie\MovieWatchProvidersResultsUSFlatrate;
use App\Dto\Tmdb\Responses\Movie\MovieWatchProvidersResultsUSRent;
use App\Dto\Tmdb\TmdbClientInterface;
use App\Entity\Movie;
use App\Entity\MovieTmdbData;
use App\Repository\MovieRepository;
use App\Services\TmdbMovieService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TmdbMovieServiceTest extends TestCase
{
    /**
     * @return array{EntityManagerInterface&MockObject, MovieRepository&MockObject, TmdbClientInterface&MockObject, MovieApiInterface&MockObject, Serializer}
     */
    public function setupDependencies(): array
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $movieRepository = $this->createMock(MovieRepository::class);
        $tmdbClient = $this->createMock(TmdbClientInterface::class);
        $movieApi = $this->createMock(MovieApiInterface::class);

        $normalizer = new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter());
        $serializer = new Serializer([new ArrayDenormalizer(), $normalizer]);

        $tmdbClient->method('movieApi')->willReturn($movieApi);

        return [$entityManager, $movieRepository, $tmdbClient, $movieApi, $serializer];
    }

    /**
     * @dataProvider moviesProvider
     */
    public function testFindTmdbDetailsData(Movie $movie): void
    {
        list($entityManager, $movieRepository, $tmdbClient, $movieApi, $serializer) = $this->setupDependencies();

        $movieDetails = MovieDetails::fromArray(['title' => 'The Movie']);
        $movieApi->method('movieDetails')->willReturn($movieDetails);

        $movieRepository->expects($this->once())
            ->method('findOneBy')
            ->with(['tmdbId' => $movie->getTmdbId()])
            ->willReturn($movie);

        $tmdbMovieService = new TmdbMovieService($movieRepository, $entityManager, $tmdbClient, $serializer);

        $detailsData = $tmdbMovieService->findTmdbDetailsData($movie->getTmdbId(), 'en');

        $expectedData = $movie->getTmdbDataForLocale('en')?->getTmdbDetailsData() ?: $serializer->normalize($movieDetails);
        $this->assertSame($expectedData, $serializer->normalize($detailsData));
    }

    public function testFindTmdbDetailsDataMovieNotFound(): void
    {
        list($entityManager, $movieRepository, $tmdbClient, $movieApi, $serializer) = $this->setupDependencies();

        $movieDetails = (new MovieDetails())->setTitle('The Movie');
        $movieApi->method('movieDetails')->willReturn($movieDetails);

        $movieRepository->expects($this->once())
            ->method('findOneBy')
            ->with(['tmdbId' => 123])
            ->willReturn(null);

        $entityManager->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Movie::class));
        $entityManager->expects($this->once())
            ->method('flush');

        $tmdbMovieService = new TmdbMovieService($movieRepository, $entityManager, $tmdbClient, $serializer);
        $detailsData = $tmdbMovieService->findTmdbDetailsData(123, 'en');

        $this->assertSame($movieDetails, $detailsData);
    }

    public function testWatchlistProvider(): void
    {
        list($entityManager, $movieRepository, $tmdbClient, $movieApi, $serializer) = $this->setupDependencies();

        $usBuy = [(new MovieWatchProvidersResultsUSBuy())->setProviderName('Amazon')];
        $usRent = [(new MovieWatchProvidersResultsUSRent())->setProviderName('Google Play')];
        $usFlatrate = [(new MovieWatchProvidersResultsUSFlatrate())->setProviderName('Netflix')];
        $usData = (new MovieWatchProvidersResultsUS())
            ->setBuy($usBuy)
            ->setFlatrate($usFlatrate)
            ->setRent($usRent)
            ->setLink('https://www.themoviedb.org/movie/123/watch');

        $deRent = [(new MovieWatchProvidersResultsDERent())->setProviderName('Google Play')];
        $deData = (new MovieWatchProvidersResultsDE())
            ->setRent($deRent)
            ->setLink('https://www.themoviedb.org/movie/123/watch');

        $movieApi->method('movieWatchProviders')->willReturn(
            (new MovieWatchProviders())->setResults((new MovieWatchProvidersResults())->setUS($usData)->setDE($deData))
        );

        $tmdbMovieService = new TmdbMovieService($movieRepository, $entityManager, $tmdbClient, $serializer);
        $usProviders = $tmdbMovieService->findWatchProviders(123, 'en-US');
        $deProviders = $tmdbMovieService->findWatchProviders(123, 'de-DE');

        $usData = [
            'link' => 'https://www.themoviedb.org/movie/123/watch',
            'buy' => $usBuy,
            'flatrate' => $usFlatrate,
            'rent' => $usRent,
        ];
        $deData = [
            'link' => 'https://www.themoviedb.org/movie/123/watch',
            'rent' => $deRent,
        ];
        $emptyData = [
            'link' => null,
            'buy' => [],
            'flatrate' => [],
            'rent' => [],
        ];

        $this->assertSame($usData, $usProviders);
        // The data is merged with empty arrays, so the data should not be the same
        $this->assertNotSame($deData, $deProviders);
        $this->assertSame(
            array_merge($emptyData, $deData),
            $deProviders
        );
        $frProviders = $tmdbMovieService->findWatchProviders(123, 'fr-FR');
        $this->assertSame($emptyData, $frProviders);
    }

    /**
     * @return iterable<array{Movie}>
     */
    public function moviesProvider(): iterable
    {
        $movie = new Movie();
        yield 'movie exists with tmdbData' => [
            $movie->setTmdbId(123)
                ->setTmdbData(
                    new ArrayCollection(
                        [
                            (new MovieTmdbData())
                                ->setMovie($movie)
                                ->setLocale('en')
                                ->setTmdbDetailsData(['title' => 'The Movie']),
                        ]
                    )
                ),
        ];
        yield 'movie exists with empty tmdbData' => [
            $movie->setTmdbId(123)
                ->setTmdbData(
                    new ArrayCollection(
                        [
                            (new MovieTmdbData())
                                ->setMovie($movie)
                                ->setLocale('en')
                                ->setTmdbDetailsData([]),
                        ]
                    )
                ),
        ];
        yield 'movie exists without tmdbData' => [
            (new Movie())->setTmdbId(123),
        ];
    }
}
