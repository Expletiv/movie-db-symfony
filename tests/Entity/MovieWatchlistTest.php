<?php

namespace App\Tests\Entity;

use App\Entity\Movie;
use App\Entity\MovieWatchlist;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class MovieWatchlistTest extends TestCase
{
    public function testMovieWatchlist(): void
    {
        $owner = (new User())
            ->setId(1)
            ->setEmail('abc@mail.com')
            ->setPassword('password');

        $watchlist = new MovieWatchlist();
        $watchlist->setName('Test Watchlist');
        $watchlist->setOwner($owner);
        $watchlist->addMovie($movie = new Movie());

        $this->assertEquals('Test Watchlist', $watchlist->getName());
        $this->assertEquals($owner, $watchlist->getOwner());
        $this->assertTrue($watchlist->hasOwner($owner));
        $this->assertTrue($watchlist->getMovies()->contains($movie));
        $this->assertCount(1, $watchlist->getMovies());

        $watchlist->removeMovie($movie);
        $this->assertFalse($watchlist->getMovies()->contains($movie));
        $this->assertCount(0, $watchlist->getMovies());
    }
}
