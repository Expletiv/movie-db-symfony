<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home')]
    public function index(
        MovieRepository $movieRepository,
        #[MapQueryParameter(options: ['min_range' => 1])] int $page = 1,
    ): Response {
        $movies = $movieRepository->findPageOrderedByPopularity($page);

        if (sizeof($movies) < 1) {
            $movies = $movieRepository->findPageOrderedByPopularity();
        }

        $tmdbMovies = array_map(fn ($movie) => $movie->getTmdbDetailsData(), $movies);

        return $this->render('home/index.html.twig', [
            'movies' => $tmdbMovies,
            'page' => $page,
            'maxPage' => $movieRepository->getMaxPage(),
        ]);
    }
}
