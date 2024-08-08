<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Entity\Movie;
use App\Entity\MovieWatchlist;
use App\Form\AddToWatchlistType;
use App\Repository\MovieRepository;
use App\Services\TmdbService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route('/{_locale}/movie/{tmdbId}/details', name: 'app_movie_details')]
    public function index(
        Request $request,
        int $tmdbId,
        TmdbService $tmdbService
    ): Response {
        $form = $this->createForm(AddToWatchlistType::class);

        return $this->render('movie_details/index.html.twig', [
            'movie' => $tmdbService->findTmdbDetailsData($tmdbId, $request->getLocale()),
            'addToWatchlistForm' => $form,
        ]);
    }

    #[Route('/{_locale}/movie/{tmdbId}/add-to-watchlist', name: 'app_movie_add_to_watchlist')]
    public function addToWatchlist(
        int $tmdbId,
        Request $request,
        MovieRepository $movieRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(AddToWatchlistType::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('forms/form_page.html.twig', [
                'form' => $form,
            ]);
        }

        $data = $form->getData();
        /** @var MovieWatchlist $watchlist */
        $watchlist = $data['watchlist'];

        $movie = $movieRepository->findOneBy(['tmdbId' => $tmdbId]);
        if (null === $movie) {
            $movie = (new Movie())
                ->setTmdbId($tmdbId);
        }
        $movie->addToWatchlist($watchlist);
        $entityManager->persist($movie);
        $entityManager->flush();

        return $this->redirectToRoute('app_movie_details', ['tmdbId' => $tmdbId]);
    }
}
