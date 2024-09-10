<?php

namespace App\Tests\Controller\Admin\Crud;

use App\Controller\Admin\Crud\MovieListItemCrudController;
use App\DataFixtures\MovieListFixtures;
use App\DataFixtures\MovieListItemFixtures;
use App\Tests\Controller\Admin\AbstractAdminCrudTestCase;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class MovieListItemCrudControllerTest extends AbstractAdminCrudTestCase
{
    protected function getControllerFqcn(): string
    {
        return MovieListItemCrudController::class;
    }

    public function testCrud(): void
    {
        $this->client->request('GET', $this->generateIndexUrl());
        $this->assertResponseIsSuccessful();

        /** @var AdminUrlGenerator $urlGenerator */
        $urlGenerator = $this->adminUrlGenerator;
        $newUrl = $urlGenerator
            ->setDashboard($this->getDashboardFqcn())
            ->setController($this->getControllerFqcn())
            ->setAction(Action::INDEX)
            ->set('movieList', MovieListFixtures::MOVIE_LIST_ID);

        $this->client->request('GET', $newUrl);
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateFilterRenderUrl());
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateDetailUrl(MovieListItemFixtures::MOVIE_LIST_ITEM_ID));
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', $this->generateEditFormUrl(MovieListItemFixtures::MOVIE_LIST_ITEM_ID));
        $this->assertResponseIsSuccessful();
    }
}
