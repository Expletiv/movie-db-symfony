<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Dto\Tmdb\Responses\Movie\MovieDetails;
use App\Repository\MovieTmdbDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class HomeController extends AbstractController
{
    #[Route('/{_locale}/home')]
    public function index(
        Request $request,
        MovieTmdbDataRepository $movieRepository,
        DenormalizerInterface $denormalizer,
        #[MapQueryParameter(options: ['min_range' => 1])] int $page = 1,
    ): Response {
        $movies = $movieRepository->findPageOrderedByPopularity($page, $request->getLocale());

        $tmdbMovies = array_map(
            fn ($movie) => $denormalizer->denormalize($movie->getTmdbDetailsData(), MovieDetails::class),
            $movies);

        $list = [
            'page' => $page,
            'results' => $tmdbMovies,
            'totalPages' => $movieRepository->getMaxPage($request->getLocale()),
            'totalResults' => $movieRepository->count(['locale' => $request->getLocale()]),
        ];

        return $this->render('home/index.html.twig', [
            'list' => $list,
        ]);
    }

    #[Route('/')]
    public function indexNoLocale(): RedirectResponse
    {
        return $this->redirectToRoute('app_frontend_home_index', ['_locale' => 'en']);
    }
}
