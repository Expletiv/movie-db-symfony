<?php

namespace App\DataFixtures;

use App\Entity\MovieWatchlist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class MovieWatchlistFixtures extends Fixture implements DependentFixtureInterface
{
    public const string MOVIE_WATCHLIST_REFERENCE = 'test_watchlist';
    public const string MOVIE_WATCHLIST_ID = 'f47ac10b-58cc-4372-a567-0e02b2c3d479';

    public function load(ObjectManager $manager): void
    {
        $watchlist = new MovieWatchlist();
        $watchlist->setId(new Uuid(self::MOVIE_WATCHLIST_ID));
        $watchlist->setName('Test Watchlist');
        $watchlist->setOwner($this->getReference(UserFixtures::TEST_USER_REFERENCE));

        $this->setReference(self::MOVIE_WATCHLIST_REFERENCE, $watchlist);

        /** @var ClassMetadata<MovieWatchlist> $metadata */
        $metadata = $manager->getClassMetaData(MovieWatchlist::class);
        $metadata->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new AssignedGenerator());
        $manager->persist($watchlist);
        $manager->flush();
    }

    /**
     * @return class-string[]
     */
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
