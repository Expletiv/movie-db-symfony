<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Services\TmdbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieDetailsController extends AbstractController
{
    #[Route('/{_locale}/movie/{tmdbId}/details')]
    public function index(
        Request $request,
        int $tmdbId,
        TmdbService $tmdbService
    ): Response {
        return $this->render('movie_details/index.html.twig', [
            'movie' => $tmdbService->findTmdbDetailsData($tmdbId, $request->getLocale()),
        ]);
    }
}
