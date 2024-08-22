<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Dto\Tmdb\Responses\Search\SearchMovieResults;
use App\Dto\Tmdb\TmdbClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class MovieAutocompleteController extends AbstractController
{
    #[Route('/admin/{_locale}/movie-autocomplete', name: 'app_movie_autocomplete')]
    public function index(#[MapQueryParameter] string $query, TmdbClientInterface $tmdbClient, Request $request): JsonResponse
    {
        $search = $tmdbClient->searchApi()->searchMovie(query: $query, language: $request->getLocale());

        $mappedMovies = array_map(function (SearchMovieResults $movie) {
            return ['value' => $movie->getId(), 'text' => $movie->getTitle()];
        }, $search->getResults());

        return new JsonResponse(['results' => $mappedMovies]);
    }
}
