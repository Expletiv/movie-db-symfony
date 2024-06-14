<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/')]
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();

        $tmdbMovies = array_map(fn ($movie) => $movie->getTmdbDetailsData(), $movies);

        return $this->render('home/index.html.twig', [
            'movies' => $tmdbMovies,
        ]);
    }
}
