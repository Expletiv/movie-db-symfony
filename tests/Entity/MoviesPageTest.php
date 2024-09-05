<?php

namespace App\Tests\Entity;

use App\Entity\MoviesPage;
use App\Entity\MoviesPageList;
use App\Enum\PageType;
use PHPUnit\Framework\TestCase;

class MoviesPageTest extends TestCase
{
    public function testMoviesPage(): void
    {
        $moviesPage = new MoviesPage();
        $moviesPage->setTitleForLocale('en', 'title');
        $moviesPage->setTitleForLocale('fr', 'titre');
        $moviesPage->setId(1);
        $moviesPage->setType(PageType::HOME);

        $this->assertEquals('title', $moviesPage->getTitleForLocale('en'));
        $this->assertEquals('titre', $moviesPage->getTitleForLocale('fr'));
        $this->assertNull($moviesPage->getTitleForLocale('de'));
        $this->assertEquals(1, $moviesPage->getId());
        $this->assertEquals(PageType::HOME->value, $moviesPage->getType());

        $this->assertCount(0, $moviesPage->getMovieLists());

        $moviesPageList = new MoviesPageList();
        $moviesPageList->setPage($moviesPage);
        $moviesPageList->setPosition(1);

        $moviesPage->addMovieList($moviesPageList);
        $this->assertCount(1, $moviesPage->getMovieLists());
        $this->assertSame($moviesPageList, $moviesPage->getMovieLists()->first());

        $moviesPage->removeMovieList($moviesPageList);
        $this->assertCount(0, $moviesPage->getMovieLists());
    }
}
