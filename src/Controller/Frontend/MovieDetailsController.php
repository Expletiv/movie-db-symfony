<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Tmdb\Client;

class MovieDetailsController extends AbstractController
{
    #[Route('/{_locale}/movie/{tmdbId}/details')]
    public function index(
        Request $request,
        int $tmdbId,
        MovieRepository $movieRepository,
        Client $tmdbClient
    ): Response {
        $movie = $movieRepository->findOneBy(['tmdbId' => $tmdbId]);

        $tmdbData = $movie?->getTmdbDataForLocale($request->getLocale());
        $tmdbData = $tmdbData?->getTmdbDetailsData();

        $tmdbData ??= $tmdbClient->getMoviesApi()->getMovie($tmdbId, ['language' => $request->getLocale()]);

        $tmdbData ?? throw new NotFoundHttpException();

        return $this->render('movie_details/index.html.twig', [
            'movie' => $tmdbData,
        ]);
    }
}
