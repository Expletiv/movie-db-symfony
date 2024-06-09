<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Tmdb\Client;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function index(MovieRepository $movieRepository, Client $tmdbClient): Response
    {
        $movies = $movieRepository->findAll();

        $movieIds = array_map(fn ($movie) => $movie->getTmdbId(), $movies);
        $tmdbMovies = [];
        foreach ($movieIds as $movieId) {
            $tmdbMovies[] = $tmdbClient->getMoviesApi()->getMovie($movieId);
        }

        return $this->render('home/index.html.twig', [
            'movies' => $tmdbMovies,
        ]);
    }
}
