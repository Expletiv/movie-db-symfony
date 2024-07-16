<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Tmdb\Client;

class MovieAutocompleteController extends AbstractController
{
    #[Route('/admin/{_locale<%app.supported_locales%>}/movie-autocomplete', name: 'app_movie_autocomplete')]
    public function index(#[MapQueryParameter] string $query, Client $client, Request $request): JsonResponse
    {
        $response = $client->getSearchApi()->searchMovies($query, ['language' => $request->getLocale()]);

        $mappedMovies = array_map(function (mixed $movie) {
            return ['value' => $movie['id'], 'text' => $movie['title']];
        }, $response['results']);

        return new JsonResponse(['results' => $mappedMovies]);
    }
}
