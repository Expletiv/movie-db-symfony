<?php

namespace App\DataFixtures;

use App\Entity\MovieList;
use Generator;

class MovieListFixtures extends DataFixture
{
    public const string MOVIE_LIST_REFERENCE = 'test_movie_list';
    public const int MOVIE_LIST_ID = 1;

    protected function provideEntities(): Generator
    {
        $movieList = new MovieList();
        $movieList->setId(self::MOVIE_LIST_ID);
        $movieList->setTitleForLocale('en', 'Test Movie List');
        $movieList->setTitleForLocale('de', 'Test Filmliste');

        $this->addReference(self::MOVIE_LIST_REFERENCE, $movieList);

        yield $movieList;
    }
}
