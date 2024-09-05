<?php

namespace App\Tests\Controller\Admin\Crud;

use App\Controller\Admin\Crud\MovieWatchlistCrudController;
use App\DataFixtures\MovieWatchlistFixtures;
use App\Tests\Controller\Admin\AbstractAdminCrudTestCase;

class MovieWatchlistCrudControllerTest extends AbstractAdminCrudTestCase
{
    protected function getControllerFqcn(): string
    {
        return MovieWatchlistCrudController::class;
    }

    public function testCrud(): void
    {
        $this->client->request('GET', $this->generateIndexUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateNewFormUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateFilterRenderUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateDetailUrl(MovieWatchlistFixtures::MOVIE_WATCHLIST_ID));
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateEditFormUrl(MovieWatchlistFixtures::MOVIE_WATCHLIST_ID));
        $this->assertResponseIsSuccessful();
    }
}
