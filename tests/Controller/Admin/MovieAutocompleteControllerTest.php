<?php

declare(strict_types=1);

namespace App\Tests\Controller\Admin;

use App\Dto\Tmdb\Clients\SearchApi\SearchApiInterface;
use App\Dto\Tmdb\Responses\Search\SearchMovie;
use App\Dto\Tmdb\Responses\Search\SearchMovieResults;
use App\Dto\Tmdb\TmdbClientInterface;
use App\Tests\Controller\AbstractWebTestCase;
use Mockery;

class MovieAutocompleteControllerTest extends AbstractWebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();

        $tmdb = Mockery::mock(TmdbClientInterface::class);
        $search = Mockery::mock(SearchApiInterface::class);
        $tmdb->allows()->searchApi()->andReturn($search);

        $results = SearchMovie::fromArray([
            'results' => [
                SearchMovieResults::fromArray([
                    'id' => 1,
                    'title' => 'Hello',
                ]),
                SearchMovieResults::fromArray([
                    'id' => 3,
                    'title' => 'Hello World',
                ]),
            ],
        ]);
        $search->shouldReceive('searchMovie')->andReturn($results);

        $client->getContainer()->set(TmdbClientInterface::class, $tmdb);

        $this->loginWithTestAdmin($client);
        $client->request('GET', '/admin/en/movie-autocomplete?query=hello');

        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString(
            json_encode(['results' => [
                ['value' => 1, 'text' => 'Hello'],
                ['value' => 3, 'text' => 'Hello World'],
            ]]),
            $client->getResponse()->getContent()
        );
    }
}
