<?php

namespace App\DataFixtures;

use App\Entity\MovieListItem;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Generator;

class MovieListItemFixtures extends DataFixture implements DependentFixtureInterface
{
    public const string MOVIE_LIST_ITEM_REFERENCE = 'test_movie_list_item';
    public const int MOVIE_LIST_ITEM_ID = 1;

    protected function provideEntities(): Generator
    {
        $movieListItem = new MovieListItem();

        $movieListItem->setId(self::MOVIE_LIST_ITEM_ID);
        $movieListItem->setMovie($this->getReference(MovieFixtures::MOVIE_REFERENCE));
        $movieListItem->setMovieList($this->getReference(MovieListFixtures::MOVIE_LIST_REFERENCE));
        $movieListItem->setPosition(0);

        $this->addReference(self::MOVIE_LIST_ITEM_REFERENCE, $movieListItem);

        yield $movieListItem;
    }

    /**
     * @return class-string[]
     */
    public function getDependencies(): array
    {
        return [
            MovieListFixtures::class,
            MovieFixtures::class,
        ];
    }
}
