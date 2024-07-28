<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Form\MovieDiscoverFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Tmdb\Client;

class MoviesController extends AbstractController
{
    public function __construct(
        private readonly Client $tmdbClient,
    ) {
    }

    #[Route('/{_locale}/popular', name: 'app_movies_popular')]
    public function popular(
        Request $request,
        #[MapQueryParameter(options: ['min_range' => 1])] int $page = 1,
    ): Response {
        $moviesResult = $this->tmdbClient->getMoviesApi()->getPopular([
            'language' => $request->getLocale(),
            'page' => $page,
        ]);

        return $this->render('movies/popular.html.twig', [
            'movies' => $moviesResult['results'],
            'page' => $page,
            'maxPage' => $moviesResult['total_pages'],
        ]);
    }

    #[Route('/{_locale}/discover', name: 'app_movies_discover')]
    public function discover(
        Request $request,
        #[MapQueryParameter(options: ['min_range' => 1])] int $page = 1,
    ): Response {
        $form = $this->createForm(MovieDiscoverFilterType::class);
        $form->handleRequest($request);
        $params = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $params['sort_by'] = $data['sortCategory'].'.'.$data['sortDirection'];
            $params['primary_release_year'] = $data['primaryReleaseYear'];
        }

        $moviesResult = $this->tmdbClient->getDiscoverApi()->discoverMovies(array_merge([
            'language' => $request->getLocale(),
            'page' => $page,
        ], $params));

        return $this->render('movies/discover.html.twig', [
            'movies' => $moviesResult['results'],
            'page' => $page,
            'maxPage' => $moviesResult['total_pages'],
            'form' => $form,
        ]);
    }

    #[Route('/{_locale}/highest-rating', name: 'app_movies_highest_rating')]
    public function highestRating(
        Request $request,
        #[MapQueryParameter(options: ['min_range' => 1])] int $page = 1,
    ): Response {
        $moviesResult = $this->tmdbClient->getMoviesApi()->getTopRated([
            'language' => $request->getLocale(),
            'page' => $page,
        ]);

        return $this->render('movies/highest_rating.html.twig', [
            'movies' => $moviesResult['results'],
            'page' => $page,
            'maxPage' => $moviesResult['total_pages'],
        ]);
    }
}
