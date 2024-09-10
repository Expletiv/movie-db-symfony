<?php

namespace App\DataFixtures;

use App\Entity\MovieWatchlist;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Generator;
use Symfony\Component\Uid\Uuid;

class MovieWatchlistFixtures extends DataFixture implements DependentFixtureInterface
{
    public const string MOVIE_WATCHLIST_REFERENCE = 'test_watchlist';
    public const string MOVIE_WATCHLIST_ID = 'f47ac10b-58cc-4372-a567-0e02b2c3d479';

    protected function provideEntities(): Generator
    {
        $watchlist = new MovieWatchlist();
        $watchlist->setId(new Uuid(self::MOVIE_WATCHLIST_ID));
        $watchlist->setName('Test Watchlist');
        $watchlist->setOwner($this->getReference(UserFixtures::TEST_USER_REFERENCE));

        $this->setReference(self::MOVIE_WATCHLIST_REFERENCE, $watchlist);

        yield $watchlist;
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
