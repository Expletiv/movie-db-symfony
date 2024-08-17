<?php

namespace App\DataFixtures;

use App\Entity\MovieWatchlist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MovieWatchlistFixtures extends Fixture implements DependentFixtureInterface
{
    public const string MOVIE_WATCHLIST_REFERENCE = 'test_watchlist';

    public function load(ObjectManager $manager): void
    {
        $watchlist = new MovieWatchlist();
        $watchlist->setName('Test Watchlist');
        $watchlist->setOwner($this->getReference(UserFixtures::TEST_USER_REFERENCE));

        $this->setReference(self::MOVIE_WATCHLIST_REFERENCE, $watchlist);
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
