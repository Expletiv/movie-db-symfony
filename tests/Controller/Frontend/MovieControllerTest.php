<?php

declare(strict_types=1);

namespace App\Tests\Controller\Frontend;

use App\Services\Interface\TmdbMovieInterface;

class MovieControllerTest extends AbstractWebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $tmdb = $this->createMock(TmdbMovieInterface::class);
        $tmdb->expects($this->once())
            ->method('findTmdbDetailsData')
            ->with(123, 'en')
            ->willReturn([
                'id' => 123,
                'title' => 'Test Movie',
                'tagline' => 'Test Tagline',
                'overview' => 'Test Overview',
                'poster_path' => '/test.jpg',
                'release_date' => '2021-01-01',
                'runtime' => 120,
                'vote_average' => 7.5,
                'backdrop_path' => '/test_backdrop.jpg',
                'genres' => [
                    ['name' => 'Test Genre'],
                ],
                'status' => 'Released',
                'budget' => 1000000,
                'revenue' => 2000000,
                'imdb_id' => 'tt1234567',
                'vote_count' => 100,
            ]);
        $container->set(TmdbMovieInterface::class, $tmdb);
        $client->request('GET', '/en/movie/123/details');

        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($client->getResponse()->getContent());
    }

    public function testAddToWatchlist(): void
    {
        $client = static::createClient();

        $client->request('GET', '/en/movie/123/add-to-watchlist');
        $this->assertResponseRedirects('/en/login', 302);

        $this->loginWithTestUser($client);

        $client->request('GET', '/en/movie/123/add-to-watchlist');
        $this->assertResponseIsSuccessful();
    }

    public function testWatchProviders(): void
    {
        $client = static::createClient();

        $tmdb = $this->createMock(TmdbMovieInterface::class);
        $tmdb->method('findWatchProviders')
            ->with(123, 'en-US')
            ->willReturn(
                [
                    'link' => 'https://www.themoviedb.org/movie/123/watch?locale=US',
                    'flatrate' => [
                        ['logo_path' => 'test.jpg', 'provider_name' => 'Netflix'],
                        ['logo_path' => 'test.jpg', 'provider_name' => 'Hulu'],
                    ],
                    'buy' => [
                        ['provider_id' => 3, 'provider_name' => 'Amazon'],
                    ],
                    'rent' => [
                        ['provider_id' => 2, 'provider_name' => 'Google Play'],
                    ],
                ],
            );
        $container = $client->getContainer();
        $container->set(TmdbMovieInterface::class, $tmdb);

        $client->request('GET', '/en/movie/123/watch-providers', server: ['HTTP_ACCEPT_LANGUAGE' => 'en-US']);
        $this->assertResponseStatusCodeSame(404);

        $client->request('GET', '/en/movie/123/watch-providers', server: ['HTTP_ACCEPT_LANGUAGE' => 'en-US', 'HTTP_Turbo-Frame' => 'watch-providers']);
        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($client->getResponse()->getContent());
    }
}
