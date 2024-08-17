<?php

namespace App\Tests\Controller\Frontend;

use App\Services\Interface\TmdbListInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Twig\Environment;

class MovieListsControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->client->getContainer()->set(Environment::class, $this->createMock(Environment::class));
    }

    public function testPopular(): void
    {
        $tmdbList = $this->createMock(TmdbListInterface::class);
        $tmdbList->expects($this->once())
            ->method('popularMovies')
            ->with([
                'language' => 'en',
                'page' => 12,
            ])
            ->willReturn([
                'page' => 12,
                'results' => [],
                'total_pages' => 100,
            ]);

        $this->client->getContainer()->set(TmdbListInterface::class, $tmdbList);

        $this->client->request('GET', '/en/popular?page=12');
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/en/popular?page=-3');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testDiscover(): void
    {
        $tmdbList = $this->createMock(TmdbListInterface::class);
        $tmdbList->expects($this->once())
            ->method('discoverMovies')
            ->with([
                'language' => 'en',
                'page' => 12,
            ])
            ->willReturn([
                'page' => 12,
                'results' => [],
                'total_pages' => 100,
            ]);

        $this->client->getContainer()->set(TmdbListInterface::class, $tmdbList);

        $this->client->request('GET', '/en/discover?page=12');
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/en/discover?page=-3');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testHighestRating(): void
    {
        $tmdbList = $this->createMock(TmdbListInterface::class);
        $tmdbList->expects($this->once())
            ->method('topRatedMovies')
            ->with([
                'language' => 'en',
                'page' => 12,
            ])
            ->willReturn([
                'page' => 12,
                'results' => [],
                'total_pages' => 100,
            ]);

        $this->client->getContainer()->set(TmdbListInterface::class, $tmdbList);

        $this->client->request('GET', '/en/highest-rating?page=12');
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/en/highest-rating?page=-3');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testSearch(): void
    {
        $tmdbList = $this->createMock(TmdbListInterface::class);
        $tmdbList->expects($this->once())
            ->method('searchMovies')
            ->withAnyParameters()
            ->willReturn([
                'page' => 12,
                'results' => [],
                'total_pages' => 100,
                'total_results' => 1000,
            ]);

        $this->client->getContainer()->set(TmdbListInterface::class, $tmdbList);

        $this->client->request('GET', '/en/search?query=test&page=12');
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/en/search');
        $this->assertResponseStatusCodeSame(404);

        $this->client->request('GET', '/en/search?page=-3');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testRecommendations(): void
    {
        $tmdbList = $this->createMock(TmdbListInterface::class);
        $tmdbList->expects($this->once())
            ->method('recommendedMovies')
            ->withAnyParameters()
            ->willReturn([
                'page' => 12,
                'results' => [],
                'total_pages' => 100,
            ]);

        $this->client->getContainer()->set(TmdbListInterface::class, $tmdbList);

        $this->client->request('GET', '/en/recommendations/123?page=1');
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/en/recommendations/123?page=20');
        $this->assertResponseStatusCodeSame(404);

        $this->client->request('GET', '/en/recommendations/123?page=-3');
        $this->assertResponseStatusCodeSame(404);
    }
}
