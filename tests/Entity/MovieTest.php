<?php

namespace App\Tests\Entity;

use App\Entity\Movie;
use App\Entity\MovieTmdbData;
use App\Entity\MovieWatchlist;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    private Movie $movie;

    protected function setUp(): void
    {
        $this->movie = (new Movie())
            ->setTitle('Test Movie')
            ->setTmdbId(123)
            ->setPopularity(1.0)
            ->setReleaseDate(new DateTimeImmutable('2021-01-01'));
    }

    public function testMovieWithTmdbData(): void
    {
        $movie = $this->movie;

        $this->assertCount(0, $movie->getTmdbData());

        $this->assertEquals('Test Movie', $movie->getTitle());
        $this->assertNull($movie->getTitle('en'));
        $this->assertNull($movie->getTitle('de'));

        $enData = (new MovieTmdbData())
            ->setLocale('en')
            ->setTitle('Tmdb English')
            ->setMovie(new Movie());

        $deData = (new MovieTmdbData())
            ->setLocale('de')
            ->setTitle('Tmdb Deutsch')
            ->setMovie(new Movie());

        $movie->addTmdbDatum($enData);
        $movie->addTmdbDatum($deData);
        $data = $movie->getTmdbDataForLocale('en');
        $this->assertSame($enData, $data);

        $this->assertEquals('Tmdb English', $movie->getTitle('en'));
        $this->assertEquals('Tmdb Deutsch', $movie->getTitle('de'));

        $this->assertCount(2, $movie->getTmdbData());
        $this->assertTrue($movie->hasLocale('en'));

        $movie->removeTmdbDatum($enData);
        $this->assertCount(1, $movie->getTmdbData());
        $this->assertSame($deData, $movie->getTmdbData()->first());
        $this->assertFalse($movie->hasLocale('en'));
    }

    public function testMovieWithWatchlists(): void
    {
        $movie = $this->movie;

        $this->assertCount(0, $movie->getWatchlists());

        $watchlist1 = new MovieWatchlist();
        $watchlist2 = new MovieWatchlist();

        $movie->addToWatchlist($watchlist1);
        $this->assertCount(1, $movie->getWatchlists());
        $this->assertSame($watchlist1, $movie->getWatchlists()->first());

        $movie->addToWatchlist($watchlist2);
        $this->assertCount(2, $movie->getWatchlists());
        $this->assertSame($watchlist2, $movie->getWatchlists()->last());

        $movie->removeFromWatchlist($watchlist1);
        $this->assertCount(1, $movie->getWatchlists());
        $this->assertSame($watchlist2, $movie->getWatchlists()->first());

        $movie->removeFromWatchlist($watchlist2);
        $this->assertCount(0, $movie->getWatchlists());
    }
}
