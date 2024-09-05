<?php

namespace App\Tests\Entity;

use App\Entity\Movie;
use App\Entity\MovieList;
use App\Entity\MovieListItem;
use Mockery;
use PHPUnit\Framework\TestCase;

class MovieListItemTest extends TestCase
{
    public function testMovieListItem(): void
    {
        $item = new MovieListItem();

        $item->setPosition(1);
        $this->assertEquals(1, $item->getPosition());

        $movie = Mockery::mock(Movie::class);
        $item->setMovie($movie);
        $this->assertSame($movie, $item->getMovie());

        $movieList = Mockery::mock(MovieList::class);
        $item->setMovieList($movieList);
        $this->assertSame($movieList, $item->getMovieList());
    }
}
