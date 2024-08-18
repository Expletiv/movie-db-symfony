<?php

namespace App\Tests\Controller\Frontend;

use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();

        $client->request('GET', '/en/profile');
        $this->assertResponseRedirects('/en/login', 302);

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->find(UserFixtures::TEST_USER_ID);
        $client->loginUser($testUser);

        $client->request('GET', '/en/profile');
        $this->assertResponseIsSuccessful();
    }
}
