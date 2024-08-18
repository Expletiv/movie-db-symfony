<?php

namespace App\Tests\Services;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Services\WatchlistService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class WatchlistServiceTest extends TestCase
{
    public function testAddMovieToWatchlists(): void
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $movieRepository = $this->createMock(MovieRepository::class);

        $movie = (new Movie())->setTmdbId(123);
        $movieRepository->expects($this->once())
            ->method('findOneBy')
            ->with(['tmdbId' => 123])
            ->willReturn($movie);

        $entityManager->expects($this->once())
            ->method('flush');

        $watchlistService = new WatchlistService($entityManager, $movieRepository);
        $watchlistService->addMovieToWatchlists(123, []);
    }

    public function testAddMovieToWatchlistsMovieNotFound(): void
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $movieRepository = $this->createMock(MovieRepository::class);

        $movieRepository->expects($this->once())
            ->method('findOneBy')
            ->with(['tmdbId' => 123])
            ->willReturn(null);

        $entityManager->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Movie::class));
        $entityManager->expects($this->once())
            ->method('flush');

        $watchlistService = new WatchlistService($entityManager, $movieRepository);
        $watchlistService->addMovieToWatchlists(123, []);
    }
}
