<?php

namespace App\Tests\Controller\Admin\Crud;

use App\Controller\Admin\Crud\UserCrudController;
use App\DataFixtures\UserFixtures;
use App\Tests\Controller\Admin\AbstractAdminCrudTestCase;

class UserCrudControllerTest extends AbstractAdminCrudTestCase
{
    protected function getControllerFqcn(): string
    {
        return UserCrudController::class;
    }

    public function testCrud(): void
    {
        $this->client->request('GET', $this->generateIndexUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateNewFormUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateFilterRenderUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateDetailUrl(UserFixtures::TEST_USER_ID));
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateEditFormUrl(UserFixtures::TEST_ADMIN_ID));
        $this->assertResponseIsSuccessful();
    }
}
