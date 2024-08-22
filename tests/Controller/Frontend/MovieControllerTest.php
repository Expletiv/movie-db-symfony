<?php

declare(strict_types=1);

namespace App\Tests\Controller\Frontend;

use App\Dto\Tmdb\Responses\Movie\MovieDetails;
use App\Dto\Tmdb\Responses\Movie\MovieDetailsGenres;
use App\Services\Interface\TmdbMovieInterface;

class MovieControllerTest extends AbstractWebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $movieDetails = (new MovieDetails())
            ->setId(123)
            ->setTitle('Test Movie')
            ->setTagline('Test Tagline')
            ->setOverview('Test Overview')
            ->setPosterPath('/test.jpg')
            ->setReleaseDate('2021-01-01')
            ->setRuntime(120)
            ->setVoteAverage(7.5)
            ->setBackdropPath('/test_backdrop.jpg')
            ->setGenres([
                (new MovieDetailsGenres())
                    ->setName('Test Genre'),
            ])
            ->setStatus('Released')
            ->setBudget(1000000)
            ->setRevenue(2000000)
            ->setImdbId('tt1234567')
            ->setVoteCount(100);

        $tmdb = $this->createMock(TmdbMovieInterface::class);
        $tmdb->expects($this->once())
            ->method('findTmdbDetailsData')
            ->with(123, 'en')
            ->willReturn($movieDetails);
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
