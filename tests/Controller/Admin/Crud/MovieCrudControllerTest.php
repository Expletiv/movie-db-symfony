<?php

namespace App\Tests\Controller\Admin\Crud;

use App\Controller\Admin\Crud\MovieCrudController;
use App\DataFixtures\MovieFixtures;
use App\Tests\Controller\Admin\AbstractAdminCrudTestCase;

class MovieCrudControllerTest extends AbstractAdminCrudTestCase
{
    protected function getControllerFqcn(): string
    {
        return MovieCrudController::class;
    }

    public function testCrud(): void
    {
        $this->client->request('GET', $this->generateIndexUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateNewFormUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateFilterRenderUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateDetailUrl(MovieFixtures::MOVIE_ID));
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateEditFormUrl(MovieFixtures::MOVIE_ID));
        $this->assertResponseIsSuccessful();
    }
}
