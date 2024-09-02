<?php

namespace App\Tests\Entity;

use App\Entity\MovieList;
use App\Entity\MoviesPage;
use App\Entity\MoviesPageList;
use Mockery;
use PHPUnit\Framework\TestCase;

class MoviesPageListTest extends TestCase
{
    public function testMoviesPageList(): void
    {
        $list = new MoviesPageList();

        $page = Mockery::mock(MoviesPage::class);
        $moviesList = Mockery::mock(MovieList::class);

        $list->setPage($page);
        $list->setList($moviesList);
        $list->setPosition(1);

        $this->assertSame($page, $list->getPage());
        $this->assertSame($moviesList, $list->getList());
        $this->assertEquals(1, $list->getPosition());
    }
}
