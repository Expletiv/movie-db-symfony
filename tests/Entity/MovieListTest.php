<?php

namespace App\Tests\Entity;

use App\Entity\MovieList;
use App\Entity\MovieListItem;
use PHPUnit\Framework\TestCase;

class MovieListTest extends TestCase
{
    public function testMovieList(): void
    {
        $movieList = new MovieList();
        $movieList->setTitleForLocale('en', 'title');
        $movieList->setTitleForLocale('fr', 'titre');
        $movieList->setId(1);

        $this->assertEquals('title', $movieList->getTitleForLocale('en'));
        $this->assertEquals('titre', $movieList->getTitleForLocale('fr'));
        $this->assertNull($movieList->getTitleForLocale('de'));
        $this->assertEquals(1, $movieList->getId());

        $item = new MovieListItem();
        $item->setMovieList($movieList);
        $item->setPosition(1);

        $movieList->addMovie($item);
        $this->assertCount(1, $movieList->getMovies());
        $this->assertSame($item, $movieList->getMovies()->first());

        $movieList->removeMovie($item);
        $this->assertCount(0, $movieList->getMovies());
    }
}
