<?php

namespace App\Tests\Entity;

use App\Entity\MovieWatchlist;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUser(): void
    {
        $user = new User();
        $user->setId(1);
        $user->setEmail('foo@mail.com');
        $user->setPassword('password');

        $this->assertEquals('foo@mail.com', $user->getEmail());
        $this->assertEquals('password', $user->getPassword());
        $this->assertFalse($user->isVerified());
        $this->assertContains('ROLE_USER', $user->getRoles());
        $this->assertCount(1, $user->getRoles());

        $user->setRoles(['ROLE_ADMIN']);
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
        $this->assertCount(2, $user->getRoles());

        $this->assertCount(0, $user->getMovieWatchlists());

        $user->addMovieWatchlist($watchlist = new MovieWatchlist());
        $this->assertTrue($user->getMovieWatchlists()->contains($watchlist));
        $this->assertCount(1, $user->getMovieWatchlists());

        $user->addMovieWatchlist($watchlist);
        $this->assertCount(1, $user->getMovieWatchlists());
        $user->addMovieWatchlist($watchlist2 = new MovieWatchlist());
        $this->assertCount(2, $user->getMovieWatchlists());

        $this->assertTrue($user->ownsWatchlists([$watchlist, $watchlist2]));
        $user->removeMovieWatchlist($watchlist);
        // The user still owns the watchlist, but it is going to be removed from the database
        $this->assertTrue($user->ownsWatchlists([$watchlist, $watchlist2]));
        $this->assertCount(1, $user->getMovieWatchlists());
    }
}
