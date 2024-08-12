<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Entity\MovieWatchlist;
use App\Entity\User;
use App\Enum\ToastStyle;
use App\Form\Watchlist\AddWatchlistType;
use App\Message\Toast\Toast;
use App\Repository\MovieRepository;
use App\Repository\MovieTmdbDataRepository;
use App\Repository\MovieWatchlistRepository;
use App\Services\ToastService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\UX\Turbo\TurboBundle;

use function Symfony\Component\Translation\t;

class WatchlistController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly MovieRepository $movieRepository,
        private readonly MovieTmdbDataRepository $tmdbDataRepository,
        private readonly MovieWatchlistRepository $watchlistRepository,
        private readonly ToastService $toastService,
    ) {
    }

    #[Route('/{_locale}/watchlists', name: 'app_movie_watchlists')]
    public function index(Request $request, #[CurrentUser] User $user): Response
    {
        /** @var MovieWatchlist[] $watchlists */
        $watchlists = $user->getMovieWatchlists();
        $posterPaths = $this->watchlistRepository->findPosterPathsForUsersWatchlists($user, $request->getLocale());

        return $this->render('movies/watchlist/index.html.twig', [
            'watchlists' => $watchlists,
            'addWatchlistForm' => $this->createForm(AddWatchlistType::class),
            'posterPaths' => $posterPaths,
        ]);
    }

    #[Route('/{_locale}/watchlists/add', name: 'app_movie_watchlists_add', methods: ['POST'])]
    public function addWatchlist(Request $request, #[CurrentUser] User $user): Response
    {
        $form = $this->createForm(AddWatchlistType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var MovieWatchlist $movieWatchlist */
            $movieWatchlist = $form->getData();
            $movieWatchlist->setOwner($user);

            $this->entityManager->persist($movieWatchlist);
            $this->entityManager->flush();

            $this->addFlash(
                'form_success',
                t('forms.add_watchlist.success_message', ['watchlistName' => $movieWatchlist->getName()])
            );

            if (TurboBundle::STREAM_FORMAT === $request->getPreferredFormat()) {
                $request->setRequestFormat(TurboBundle::STREAM_FORMAT);

                return $this->render('components/modal/streams/add_watchlist_success.stream.html.twig', [
                    'form' => $form,
                    'watchlist' => $movieWatchlist,
                    'posterPaths' => $this->watchlistRepository->findPosterPathsForUsersWatchlists($user, $request->getLocale()),
                ]);
            }
        }

        return $this->redirectToRoute('app_movie_watchlists');
    }

    #[Route('/{_locale}/watchlists/{id}/delete', name: 'app_movie_watchlists_delete', methods: ['POST'])]
    public function deleteWatchlist(Request $request, #[CurrentUser] User $user, MovieWatchlist $watchlist): Response
    {
        if (!$this->isCsrfTokenValid('delete-watchlist-'.$watchlist->getId(), $request->getPayload()->getString('_token'))) {
            throw new BadRequestHttpException('CSRF token invalid');
        }

        if (!$watchlist->hasOwner($user)) {
            throw $this->createAccessDeniedException();
        }

        $this->entityManager->remove($watchlist);
        $this->entityManager->flush();

        $this->toastService->addToast(new Toast(
            t('forms.delete_watchlist.success_message', ['watchlistName' => $watchlist->getName()]),
            ToastStyle::SUCCESS
        ));

        return $this->redirectToRoute('app_movie_watchlists');
    }

    #[Route('/{_locale}/watchlists/{id}', name: 'app_movie_watchlists_show')]
    public function showWatchlist(
        Request $request,
        #[CurrentUser] User $user,
        MovieWatchlist $watchlist,
        #[MapQueryParameter(options: ['min_range' => 1])] int $page = 1,
    ): Response {
        if (!$watchlist->hasOwner($user)) {
            throw $this->createAccessDeniedException();
        }

        $maxWatchlistPage = $this->tmdbDataRepository->getMaxWatchlistPage($watchlist->getId(), $request->getLocale());
        $page = min($page, $maxWatchlistPage);

        $movies = $this->tmdbDataRepository->findWatchlistMovies($watchlist->getId(), $page, $request->getLocale());
        $tmdbMovies = array_map(fn ($movie) => $movie->getTmdbDetailsData(), $movies);

        return $this->render('movies/watchlist/show.html.twig', [
            'watchlist' => $watchlist,
            'movies' => $tmdbMovies,
            'page' => $page,
            'maxPage' => $maxWatchlistPage,
        ]);
    }

    #[Route('/{_locale}/watchlists/{id}/delete-movie/{tmdbId}', name: 'app_movie_watchlists_delete_movie', methods: ['POST'])]
    public function deleteFromWatchlist(
        Request $request,
        #[CurrentUser] User $user,
        MovieWatchlist $watchlist,
        int $tmdbId,
        #[MapQueryParameter(options: ['min_range' => 1])] int $page = 1,
    ): ?Response {
        if (!$this->isCsrfTokenValid('delete-watchlist-movie-'.$tmdbId, $request->getPayload()->getString('_token'))) {
            throw new BadRequestHttpException('CSRF token invalid');
        }

        if (!$watchlist->hasOwner($user)) {
            throw $this->createAccessDeniedException();
        }

        $movie = $this->movieRepository->findOneBy(['tmdbId' => $tmdbId]);

        if (null !== $movie) {
            $watchlist->removeMovie($movie);
        }
        $this->entityManager->flush();

        $this->toastService->addToast(new Toast(
            t('forms.delete_from_watchlist.success_message'),
            ToastStyle::SUCCESS
        ));
        $this->addFlash('watchlist_edit', 1);

        return $this->redirectToRoute('app_movie_watchlists_show', [
            'id' => $watchlist->getId(),
            'page' => $page,
        ]);
    }
}
