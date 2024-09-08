<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Dto\Tmdb\TmdbClientInterface;
use App\Form\MovieDiscoverFilterType;
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
        private readonly TmdbClientInterface $tmdbClient,
    ) {
    }

    #[Route('/{_locale}/popular', name: 'app_movies_popular')]
    public function popular(
        Request $request,
        #[MapQueryParameter(options: ['min_range' => 1, 'max_range' => self::TMDB_MAX_PAGE])] int $page = 1,
    ): Response {
        $moviePopularList = $this->tmdbClient->movieApi()->moviePopularList(
            page: $page,
            language: $request->getLocale()
        );
        $moviePopularList->setTotalPages(min($moviePopularList->getTotalPages(), self::TMDB_MAX_PAGE));

        return $this->render('movies/popular.html.twig', [
            'list' => $moviePopularList,
        ]);
    }

    #[Route('/{_locale}/discover', name: 'app_movies_discover')]
    public function discover(
        Request $request,
        #[MapQueryParameter(options: ['min_range' => 1, 'max_range' => self::TMDB_MAX_PAGE])] int $page = 1,
    ): Response {
        $form = $this->createForm(MovieDiscoverFilterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $sortBy = $data['sortCategory'].'.'.$data['sortDirection'];
            $withGenres = implode($data['genreLogic'], $data['genres'] ?? []);
        }

        $discoverMovie = $this->tmdbClient->discoverApi()->discoverMovie(
            page: $page,
            primaryReleaseYear: $data['primaryReleaseYear'] ?? null,
            language: $request->getLocale(),
            withGenres: $withGenres ?? null,
            sortBy: $sortBy ?? null,
        );
        $discoverMovie->setTotalPages(min($discoverMovie->getTotalPages(), self::TMDB_MAX_PAGE));

        return $this->render('movies/discover.html.twig', [
            'list' => $discoverMovie,
            'form' => $form,
        ]);
    }

    #[Route('/{_locale}/highest-rating', name: 'app_movies_highest_rating')]
    public function highestRating(
        Request $request,
        #[MapQueryParameter(options: ['min_range' => 1, 'max_range' => self::TMDB_MAX_PAGE])] int $page = 1,
    ): Response {
        $movieTopRatedList = $this->tmdbClient->movieApi()->movieTopRatedList(
            page: $page,
            language: $request->getLocale()
        );
        $movieTopRatedList->setTotalPages(min($movieTopRatedList->getTotalPages(), self::TMDB_MAX_PAGE));

        return $this->render('movies/highest_rating.html.twig', [
            'list' => $movieTopRatedList,
        ]);
    }

    #[Route('/{_locale}/search', name: 'app_movies_search')]
    public function search(
        Request $request,
        #[MapQueryParameter] string $query,
        #[MapQueryParameter(options: ['min_range' => 1, 'max_range' => self::TMDB_MAX_PAGE])] int $page = 1,
    ): Response {
        $searchMovie = $this->tmdbClient->searchApi()->searchMovie(
            query: $query,
            page: $page,
            language: $request->getLocale(),
        );
        $searchMovie->setTotalPages(min($searchMovie->getTotalPages(), self::TMDB_MAX_PAGE));

        return $this->render('movies/search.html.twig', [
            'list' => $searchMovie,
            'query' => $query,
        ]);
    }

    #[Route('/{_locale}/recommendations/{tmdbId}', name: 'app_movies_recommendations')]
    public function recommendations(
        Request $request,
        int $tmdbId,
        #[MapQueryParameter(options: ['min_range' => 1, 'max_range' => self::TMDB_RECOMMENDATIONS_MAX_PAGE])] int $page = 1,
    ): Response {
        $movieRecommendations = $this->tmdbClient->movieApi()->movieRecommendations(
            movieId: $tmdbId,
            page: $page,
            language: $request->getLocale()
        );
        $movieRecommendations->setTotalPages(min($movieRecommendations->getTotalPages(), self::TMDB_RECOMMENDATIONS_MAX_PAGE));

        return $this->render('movies/recommendations.html.twig', [
            'list' => $movieRecommendations,
        ]);
    }
}
