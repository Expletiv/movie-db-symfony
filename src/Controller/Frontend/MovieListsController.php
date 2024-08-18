<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Form\MovieDiscoverFilterType;
use App\Services\Interface\TmdbListInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class MovieListsController extends AbstractController
{
    private const int TMDB_MAX_PAGE = 500;
    private const int TMDB_RECOMMENDATIONS_MAX_PAGE = 2;

    public function __construct(
        private readonly TmdbListInterface $tmdbList,
    ) {
    }

    #[Route('/{_locale}/popular', name: 'app_movies_popular')]
    public function popular(
        Request $request,
        #[MapQueryParameter(options: ['min_range' => 1, 'max_range' => self::TMDB_MAX_PAGE])] int $page = 1,
    ): Response {
        $moviesResult = $this->tmdbList->popularMovies([
            'language' => $request->getLocale(),
            'page' => $page,
        ]);

        return $this->render('movies/popular.html.twig', [
            'movies' => $moviesResult['results'],
            'page' => $page,
            'maxPage' => min($moviesResult['total_pages'], self::TMDB_MAX_PAGE),
        ]);
    }

    #[Route('/{_locale}/discover', name: 'app_movies_discover')]
    public function discover(
        Request $request,
        #[MapQueryParameter(options: ['min_range' => 1, 'max_range' => self::TMDB_MAX_PAGE])] int $page = 1,
    ): Response {
        $form = $this->createForm(MovieDiscoverFilterType::class);
        $form->handleRequest($request);
        $params = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $params['sort_by'] = $data['sortCategory'].'.'.$data['sortDirection'];
            $params['primary_release_year'] = $data['primaryReleaseYear'];
        }

        $moviesResult = $this->tmdbList->discoverMovies(array_merge([
            'language' => $request->getLocale(),
            'page' => $page,
        ], $params));

        return $this->render('movies/discover.html.twig', [
            'movies' => $moviesResult['results'],
            'page' => $page,
            'maxPage' => min($moviesResult['total_pages'], self::TMDB_MAX_PAGE),
            'form' => $form,
        ]);
    }

    #[Route('/{_locale}/highest-rating', name: 'app_movies_highest_rating')]
    public function highestRating(
        Request $request,
        #[MapQueryParameter(options: ['min_range' => 1, 'max_range' => self::TMDB_MAX_PAGE])] int $page = 1,
    ): Response {
        $moviesResult = $this->tmdbList->topRatedMovies([
            'language' => $request->getLocale(),
            'page' => $page,
        ]);

        return $this->render('movies/highest_rating.html.twig', [
            'movies' => $moviesResult['results'],
            'page' => $page,
            'maxPage' => min($moviesResult['total_pages'], self::TMDB_MAX_PAGE),
        ]);
    }

    #[Route('/{_locale}/search', name: 'app_movies_search')]
    public function search(
        Request $request,
        #[MapQueryParameter] string $query,
        #[MapQueryParameter(options: ['min_range' => 1, 'max_range' => self::TMDB_MAX_PAGE])] int $page = 1,
    ): Response {
        $moviesResult = $this->tmdbList->searchMovies(
            $query,
            [
                'language' => $request->getLocale(),
                'page' => $page,
            ]
        );

        return $this->render('movies/search.html.twig', [
            'movies' => $moviesResult['results'],
            'page' => $page,
            'maxPage' => min($moviesResult['total_pages'], self::TMDB_MAX_PAGE),
            'query' => $query,
            'searchResults' => $moviesResult['total_results'],
        ]);
    }

    // recommendations
    #[Route('/{_locale}/recommendations/{tmdbId}', name: 'app_movies_recommendations')]
    public function recommendations(
        Request $request,
        int $tmdbId,
        #[MapQueryParameter(options: ['min_range' => 1, 'max_range' => self::TMDB_RECOMMENDATIONS_MAX_PAGE])] int $page = 1,
    ): Response {
        $moviesResult = $this->tmdbList->recommendedMovies($tmdbId, [
            'language' => $request->getLocale(),
            'page' => $page,
        ]);

        return $this->render('movies/recommendations.html.twig', [
            'movies' => $moviesResult['results'],
            'page' => $page,
            'maxPage' => min($moviesResult['total_pages'], self::TMDB_RECOMMENDATIONS_MAX_PAGE),
        ]);
    }
}
