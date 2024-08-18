<?php

namespace App\Tests\Entity;

use App\Entity\Movie;
use App\Entity\MovieTmdbData;
use PHPUnit\Framework\TestCase;

class MovieTmdbDataTest extends TestCase
{
    public function testMovieTmdbData(): void
    {
        $tmdbData = new MovieTmdbData();
        $tmdbData->setId(1);
        $tmdbData->setLocale('en');
        $tmdbData->setTitle('The Movie');
        $tmdbData->setTmdbData(['title' => 'The Movie']);
        $tmdbData->setTmdbDetailsData(['title' => 'The Movie']);
        $movie = (new Movie())->setTmdbId(123);
        $tmdbData->setMovie($movie);

        $this->assertSame(1, $tmdbData->getId());
        $this->assertSame('en', $tmdbData->getLocale());
        $this->assertSame('The Movie', $tmdbData->getTitle());
        $this->assertSame(['title' => 'The Movie'], $tmdbData->getTmdbData());
        $this->assertSame(['title' => 'The Movie'], $tmdbData->getTmdbDetailsData());
        $this->assertSame($movie, $tmdbData->getMovie());
    }
}
