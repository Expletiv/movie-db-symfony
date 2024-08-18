<?php

namespace App\Tests\Services;

use App\Entity\Movie;
use App\Entity\MovieTmdbData;
use App\Repository\MovieRepository;
use App\Services\TmdbMovieService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tmdb\Api\Movies;
use Tmdb\Client;

class TmdbMovieServiceTest extends TestCase
{
    /**
     * @return array{EntityManagerInterface&MockObject, MovieRepository&MockObject, Client&MockObject, array{title: string}}
     */
    public function setupDependencies(): array
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $movieRepository = $this->createMock(MovieRepository::class);
        $tmdbClient = $this->createMock(Client::class);
        $moviesApi = $this->createMock(Movies::class);

        $tmdbData = ['title' => 'The Movie'];
        $tmdbClient->method('getMoviesApi')->willReturn($moviesApi);
        $moviesApi->method('getMovie')->willReturn($tmdbData);

        return [$entityManager, $movieRepository, $tmdbClient, $tmdbData];
    }

    /**
     * @dataProvider moviesProvider
     */
    public function testFindTmdbDetailsData(Movie $movie): void
    {
        list($entityManager, $movieRepository, $tmdbClient, $tmdbData) = $this->setupDependencies();

        $movieRepository->expects($this->once())
            ->method('findOneBy')
            ->with(['tmdbId' => $movie->getTmdbId()])
            ->willReturn($movie);

        $tmdbMovieService = new TmdbMovieService($tmdbClient, $movieRepository, $entityManager);
        $detailsData = $tmdbMovieService->findTmdbDetailsData($movie->getTmdbId(), 'en');

        $expectedData = $movie->getTmdbDataForLocale('en')?->getTmdbDetailsData() ?: $tmdbData;
        $this->assertSame($expectedData, $detailsData);
    }

    public function testFindTmdbDetailsDataMovieNotFound(): void
    {
        list($entityManager, $movieRepository, $tmdbClient, $tmdbData) = $this->setupDependencies();

        $movieRepository->expects($this->once())
            ->method('findOneBy')
            ->with(['tmdbId' => 123])
            ->willReturn(null);

        $entityManager->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Movie::class));
        $entityManager->expects($this->once())
            ->method('flush');

        $tmdbMovieService = new TmdbMovieService($tmdbClient, $movieRepository, $entityManager);
        $detailsData = $tmdbMovieService->findTmdbDetailsData(123, 'en');

        $this->assertSame($tmdbData, $detailsData);
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
