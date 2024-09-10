<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use DateTimeImmutable;
use Generator;

class MovieFixtures extends DataFixture
{
    public const string MOVIE_REFERENCE = 'test_movie';
    public const int MOVIE_ID = 1;
    public const int MOVIE_TMDB_ID = 1;

    public function provideEntities(): Generator
    {
        $movie = new Movie();
        $movie->setId(self::MOVIE_ID);
        $movie->setTitle('Test Movie');
        $movie->setTmdbId(self::MOVIE_TMDB_ID);
        $movie->setPopularity(1.0);
        $movie->setReleaseDate(new DateTimeImmutable('2021-01-01'));

        $this->addReference(self::MOVIE_REFERENCE, $movie);

        yield $movie;
    }
}
