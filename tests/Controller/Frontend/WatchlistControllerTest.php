<?php

namespace App\Tests\Controller\Frontend;

use App\DataFixtures\MovieWatchlistFixtures;
use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WatchlistControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();

        $client->request('GET', '/en/watchlists');
        $this->assertResponseRedirects('/en/login', 302);

        $this->loginWithTestUser($client);

        $client->request('GET', '/en/watchlists');
        $this->assertResponseIsSuccessful();
    }

    public function testAddWatchlist(): void
    {
        $client = static::createClient();

        $client->request('POST', '/en/watchlists/add');
        $this->assertResponseRedirects('/en/login', 302);

        $this->loginWithTestUser($client);

        $client->request('POST', '/en/watchlists/add');
        $this->assertResponseRedirects('/en/watchlists', 302);
    }

    public function testDeleteWatchlist(): void
    {
        $client = static::createClient();

        // Deleting without being logged in does not work
        $client->request('POST', '/en/watchlists/'.MovieWatchlistFixtures::MOVIE_WATCHLIST_ID.'/delete');
        $this->assertResponseRedirects('/en/login', 302);

        // Deleting without csrf token does not work
        $this->loginWithTestUser($client);
        $client->request('POST', '/en/watchlists/'.MovieWatchlistFixtures::MOVIE_WATCHLIST_ID.'/delete');
        $this->assertResponseRedirects('/en/login', 302);
    }

    public function testShowWatchlist(): void
    {
        $client = static::createClient();

        $client->request('GET', '/en/watchlists/'.MovieWatchlistFixtures::MOVIE_WATCHLIST_ID);
        $this->assertResponseRedirects('/en/login', 302);

        $this->loginWithTestUser($client);
        $client->request('GET', '/en/watchlists/'.MovieWatchlistFixtures::MOVIE_WATCHLIST_ID);
        $this->assertResponseIsSuccessful();
    }

    public function testDeleteFromWatchlist(): void
    {
        $client = static::createClient();

        // Deleting without being logged in does not work
        $client->request('POST', '/en/watchlists/'.MovieWatchlistFixtures::MOVIE_WATCHLIST_ID.'/delete-movie/1');
        $this->assertResponseRedirects('/en/login', 302);

        // Deleting without csrf token does not work
        $this->loginWithTestUser($client);
        $client->request('POST', '/en/watchlists/'.MovieWatchlistFixtures::MOVIE_WATCHLIST_ID.'/delete-movie/1');
        $this->assertResponseRedirects('/en/login', 302);
    }

    public function loginWithTestUser(KernelBrowser $client): void
    {
        $userRepository = $client->getContainer()->get(UserRepository::class);
        $testUser = $userRepository->find(UserFixtures::TEST_USER_ID);
        $client->loginUser($testUser);
    }
}
