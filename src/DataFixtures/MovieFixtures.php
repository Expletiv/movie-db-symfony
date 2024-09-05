<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use App\Entity\MovieWatchlist;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public const string MOVIE_REFERENCE = 'test_movie';
    public const int MOVIE_ID = 1;
    public const int MOVIE_TMDB_ID = 1;

    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setId(self::MOVIE_ID);
        $movie->setTitle('Test Movie');
        $movie->setTmdbId(self::MOVIE_TMDB_ID);
        $movie->setPopularity(1.0);
        $movie->setReleaseDate(new DateTimeImmutable('2021-01-01'));

        $this->addReference(self::MOVIE_REFERENCE, $movie);

        /** @var ClassMetadata<MovieWatchlist> $metadata */
        $metadata = $manager->getClassMetaData(Movie::class);
        $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new AssignedGenerator());

        $manager->persist($movie);
        $manager->flush();
    }
}
