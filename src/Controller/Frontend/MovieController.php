<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Entity\MovieWatchlist;
use App\Entity\User;
use App\Form\Watchlist\AddToWatchlistType;
use App\Services\Interface\TmdbMovieInterface;
use App\Services\Interface\WatchlistInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Locale;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

use function Symfony\Component\Translation\t;

class MovieController extends AbstractController
{
    #[Route('/{_locale}/movie/{tmdbId}/details', name: 'app_movie_details')]
    public function index(
        Request $request,
        int $tmdbId,
        TmdbMovieInterface $tmdb
    ): Response {
        $form = $this->createForm(AddToWatchlistType::class);

        return $this->render('movie_details/index.html.twig', [
            'movie' => $tmdb->findTmdbDetailsData($tmdbId, $request->getLocale()),
            'addToWatchlistForm' => $form,
        ]);
    }

    #[Route('/{_locale}/movie/{tmdbId}/add-to-watchlist', name: 'app_movie_add_to_watchlist')]
    public function addToWatchlist(
        Request $request,
        int $tmdbId,
        WatchlistInterface $watchlistService,
        #[CurrentUser] User $user,
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

        if (!$user->ownsWatchlists($watchlists)) {
            throw $this->createAccessDeniedException();
        }
        $watchlistService->addMovieToWatchlists($tmdbId, $watchlists);
        $this->addFlash('form_success', t('forms.add_to_watchlist.success_message'));

        return $this->render('forms/form_page.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    #[Route('/{_locale}/movie/{tmdbId}/watch-providers', name: 'app_movie_watch_providers')]
    public function watchProviders(
        Request $request,
        int $tmdbId,
        TmdbMovieInterface $tmdb
    ): Response {
        if (null === $request->headers->get('Turbo-Frame')) {
            throw $this->createNotFoundException();
        }
        $locale = Locale::acceptFromHttp($request->headers->get('accept-language')) ?: $request->getLocale();

        return $this->render('movie_details/watch_providers.html.twig', [
            'tmdbId' => $tmdbId,
            'providers' => $tmdb->findWatchProviders($tmdbId, $locale),
        ]);
    }
}
