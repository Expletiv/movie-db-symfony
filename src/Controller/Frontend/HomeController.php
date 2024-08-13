<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Repository\MovieTmdbDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/{_locale}/home')]
    public function index(
        Request $request,
        MovieTmdbDataRepository $movieRepository,
        #[MapQueryParameter(options: ['min_range' => 1])] int $page = 1,
    ): Response {
        $movies = $movieRepository->findPageOrderedByPopularity($page, $request->getLocale());

        $tmdbMovies = array_map(fn ($movie) => $movie->getTmdbDetailsData(), $movies);

        return $this->render('home/index.html.twig', [
            'movies' => $tmdbMovies,
            'page' => $page,
            'maxPage' => $movieRepository->getMaxPage($request->getLocale()),
        ]);
    }

    #[Route('/')]
    public function indexNoLocale(): RedirectResponse
    {
        return $this->redirectToRoute('app_frontend_home_index', ['_locale' => 'en']);
    }
}
