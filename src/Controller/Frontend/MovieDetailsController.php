<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieDetailsController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}/movie/{tmdbId}/details')]
    public function index(Request $request, int $tmdbId, MovieRepository $movieRepository): Response
    {
        $movie = $movieRepository->findOneBy(['tmdbId' => $tmdbId, 'locale' => $request->getLocale()]);

        if (empty($movie->getTmdbDetailsData())) {
            throw $this->createNotFoundException();
        }

        return $this->render('movie_details/index.html.twig', [
            'movie' => $movie->getTmdbDetailsData(),
        ]);
    }
}
