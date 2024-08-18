<?php

namespace App\Tests\Controller\Frontend;

use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractWebTestCase extends WebTestCase
{
    public function loginWithTestUser(KernelBrowser $client): void
    {
        $userRepository = $client->getContainer()->get(UserRepository::class);
        $testUser = $userRepository->find(UserFixtures::TEST_USER_ID);
        $client->loginUser($testUser);
    }
}
