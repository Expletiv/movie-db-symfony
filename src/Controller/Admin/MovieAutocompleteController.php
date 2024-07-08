<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Tmdb\Client;

class MovieAutocompleteController extends AbstractController
{
    #[Route('/movie-autocomplete')]
    public function index(#[MapQueryParameter] string $query, Client $client): JsonResponse
    {
        $response = $client->getSearchApi()->searchMovies($query);

        $mappedMovies = array_map(function (mixed $movie) {
            return ['value' => $movie['id'], 'text' => $movie['title']];
        }, $response['results']);

        return new JsonResponse(['results' => $mappedMovies]);
    }
}
