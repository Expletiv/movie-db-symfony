<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieDetailsController extends AbstractController
{
    #[Route('/movie/{tmdbId}/details')]
    public function index(Movie $movie): Response
    {
        if (empty($movie->getTmdbDetailsData())) {
            throw $this->createNotFoundException();
        }

        return $this->render('movie_details/index.html.twig', [
            'movie' => $movie->getTmdbDetailsData(),
        ]);
    }
}
