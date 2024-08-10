<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Entity\MovieWatchlist;
use App\Form\Watchlist\AddToWatchlistType;
use App\Services\TmdbService;
use App\Services\UserProvider;
use App\Services\WatchlistService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use function Symfony\Component\Translation\t;

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
        WatchlistService $watchlistService,
        UserProvider $userProvider,
    ): Response {
        $form = $this->createForm(AddToWatchlistType::class);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->render('forms/form_page.html.twig', [
                'form' => $form,
            ]);
        }
        $data = $form->getData();
        /** @var ArrayCollection<int, MovieWatchlist> $watchlists */
        $watchlists = $data['watchlists'];

        $user = $userProvider->authenticateUser();
        if (!$user->ownsWatchlists($watchlists)) {
            $this->createAccessDeniedException();
        }

        $watchlistService->addMovieToWatchlists($tmdbId, $watchlists->toArray());

        $this->addFlash(
            'form_success',
            t('forms.add_to_watchlist.success_message')
        );

        return $this->redirectToRoute('app_movie_details', ['tmdbId' => $tmdbId]);
    }
}
