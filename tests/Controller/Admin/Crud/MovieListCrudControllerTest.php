<?php

namespace App\Tests\Controller\Admin\Crud;

use App\Controller\Admin\Crud\MovieListCrudController;
use App\DataFixtures\MovieListFixtures;
use App\Tests\Controller\Admin\AbstractAdminCrudTestCase;

class MovieListCrudControllerTest extends AbstractAdminCrudTestCase
{
    protected function getControllerFqcn(): string
    {
        return MovieListCrudController::class;
    }

    public function testCrud(): void
    {
        $this->client->request('GET', $this->generateIndexUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateNewFormUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateFilterRenderUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateDetailUrl(MovieListFixtures::MOVIE_LIST_ID));
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateEditFormUrl(MovieListFixtures::MOVIE_LIST_ID));
        $this->assertResponseIsSuccessful();
    }
}
