<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\DashboardController;
use App\DataFixtures\UserFixtures;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Test\AbstractCrudTestCase;

abstract class AbstractAdminCrudTestCase extends AbstractCrudTestCase
{
    protected function getDashboardFqcn(): string
    {
        return DashboardController::class;
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->adminUrlGenerator->set('_locale', 'en');

        $userRepository = $this->client->getContainer()->get(UserRepository::class);
        $testAdmin = $userRepository->find(UserFixtures::TEST_ADMIN_ID);
        $this->client->loginUser($testAdmin);
    }
}
