<?php

namespace App\Tests\Controller\Frontend;

use App\Dto\Tmdb\Clients\DiscoverApi\DiscoverApiInterface;
use App\Dto\Tmdb\Clients\GenreApi\GenreApiInterface;
use App\Dto\Tmdb\Clients\MovieApi\MovieApiInterface;
use App\Dto\Tmdb\Clients\SearchApi\SearchApiInterface;
use App\Dto\Tmdb\Responses\Discover\DiscoverMovie;
use App\Dto\Tmdb\Responses\Genre\GenreMovieList;
use App\Dto\Tmdb\Responses\Movie\MoviePopularList;
use App\Dto\Tmdb\Responses\Movie\MovieRecommendations;
use App\Dto\Tmdb\Responses\Movie\MovieTopRatedList;
use App\Dto\Tmdb\Responses\Search\SearchMovie;
use App\Dto\Tmdb\TmdbClientInterface;
use Mockery;
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
        $tmdb = Mockery::mock(TmdbClientInterface::class);
        $movieApi = Mockery::mock(MovieApiInterface::class);
        $tmdb->allows()->movieApi()->andReturn($movieApi);

        $moviePopularList = (new MoviePopularList())
            ->setPage(12)
            ->setResults([])
            ->setTotalPages(100)
            ->setTotalResults(2000);

        $movieApi->shouldReceive('moviePopularList')->andReturn($moviePopularList);

        $this->client->getContainer()->set(TmdbClientInterface::class, $tmdb);

        $this->client->request('GET', '/en/popular?page=12');
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/en/popular?page=-3');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testDiscover(): void
    {
        $tmdb = Mockery::mock(TmdbClientInterface::class);
        $discoverApi = Mockery::mock(DiscoverApiInterface::class);
        $genreApi = Mockery::mock(GenreApiInterface::class);
        $tmdb->allows()->discoverApi()->andReturn($discoverApi);
        $tmdb->allows()->genreApi()->andReturn($genreApi);

        $discoverList = (new DiscoverMovie())
            ->setPage(12)
            ->setResults([])
            ->setTotalPages(100)
            ->setTotalResults(2000);

        $discoverApi->shouldReceive('discoverMovie')->andReturn($discoverList);
        $genreApi->shouldReceive('genreMovieList')->andReturn(GenreMovieList::fromArray([
            'genres' => [
                ['id' => 1, 'name' => 'Test Genre'],
            ],
        ]));

        $this->client->getContainer()->set(TmdbClientInterface::class, $tmdb);

        $this->client->request('GET', '/en/discover?page=12');
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/en/discover?page=-3');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testHighestRating(): void
    {
        $tmdb = Mockery::mock(TmdbClientInterface::class);
        $movieApi = Mockery::mock(MovieApiInterface::class);
        $tmdb->allows()->movieApi()->andReturn($movieApi);

        $movieApi->shouldReceive('movieTopRatedList')->andReturn(
            (new MovieTopRatedList())
                ->setPage(12)
                ->setResults([])
                ->setTotalPages(100)
                ->setTotalResults(2000)
        );

        $this->client->getContainer()->set(TmdbClientInterface::class, $tmdb);

        $this->client->request('GET', '/en/highest-rating?page=12');
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/en/highest-rating?page=-3');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testSearch(): void
    {
        $tmdb = Mockery::mock(TmdbClientInterface::class);
        $searchApi = Mockery::mock(SearchApiInterface::class);
        $tmdb->allows()->searchApi()->andReturn($searchApi);

        $searchApi->shouldReceive('searchMovie')->andReturn(
            (new SearchMovie())
                ->setPage(12)
                ->setResults([])
                ->setTotalPages(100)
                ->setTotalResults(2000)
        );

        $this->client->getContainer()->set(TmdbClientInterface::class, $tmdb);

        $this->client->request('GET', '/en/search?query=test&page=12');
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/en/search');
        $this->assertResponseStatusCodeSame(404);

        $this->client->request('GET', '/en/search?page=-3');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testRecommendations(): void
    {
        $tmdb = Mockery::mock(TmdbClientInterface::class);
        $movieApi = Mockery::mock(MovieApiInterface::class);
        $tmdb->allows()->movieApi()->andReturn($movieApi);

        $movieApi->shouldReceive('movieRecommendations')->andReturn(
            (new MovieRecommendations())
                ->setPage(12)
                ->setResults([])
                ->setTotalPages(100)
                ->setTotalResults(2000)
        );

        $this->client->getContainer()->set(TmdbClientInterface::class, $tmdb);

        $this->client->request('GET', '/en/recommendations/123?page=1');
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/en/recommendations/123?page=20');
        $this->assertResponseStatusCodeSame(404);

        $this->client->request('GET', '/en/recommendations/123?page=-3');
        $this->assertResponseStatusCodeSame(404);
    }
}
