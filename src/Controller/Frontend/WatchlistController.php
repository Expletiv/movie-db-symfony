<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Entity\MovieWatchlist;
use App\Enum\ToastStyle;
use App\Form\Watchlist\AddWatchlistType;
use App\Message\Toast\Toast;
use App\Repository\MovieTmdbDataRepository;
use App\Repository\MovieWatchlistRepository;
use App\Services\ToastService;
use App\Services\UserProvider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\UX\Turbo\TurboBundle;

use function Symfony\Component\Translation\t;

#[IsGranted('IS_AUTHENTICATED')]
class WatchlistController extends AbstractController
{
    public function __construct(
        private readonly UserProvider $userProvider,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/{_locale}/watchlists', name: 'app_movie_watchlists')]
    public function index(MovieWatchlistRepository $watchlistRepository, Request $request): Response
    {
        $user = $this->userProvider->authenticateUser();

        /** @var MovieWatchlist[] $watchlists */
        $watchlists = $user->getMovieWatchlists();
        $posterPaths = $watchlistRepository->findPosterPathsForUsersWatchlists($user, $request->getLocale());

        return $this->render('movies/watchlist/index.html.twig', [
            'watchlists' => $watchlists,
            'addWatchlistForm' => $this->createForm(AddWatchlistType::class),
            'posterPaths' => $posterPaths,
        ]);
    }

    #[Route('/{_locale}/watchlists/add', name: 'app_movie_watchlists_add', methods: ['POST'])]
    public function addWatchlist(Request $request, MovieWatchlistRepository $watchlistRepository): Response
    {
        $user = $this->userProvider->authenticateUser();

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

                return $this->render('components/modal/streams/watchlist_success_stream.html.twig', [
                    'form' => $form,
                    'watchlist' => $movieWatchlist,
                    'posterPaths' => $watchlistRepository->findPosterPathsForUsersWatchlists($user, $request->getLocale()),
                ]);
            }
        }

        return $this->redirectToRoute('app_movie_watchlists');
    }

    #[Route('/{_locale}/watchlists/{id}', name: 'app_movie_watchlists_show')]
    public function showWatchlist(
        MovieWatchlist $watchlist,
        MovieTmdbDataRepository $tmdbDataRepository,
        Request $request,
        #[MapQueryParameter(options: ['min_range' => 1])] int $page = 1,
    ): Response {
        $user = $this->userProvider->authenticateUser();

        if (!$watchlist->hasOwner($user)) {
            throw $this->createAccessDeniedException();
        }

        $movies = $tmdbDataRepository->findWatchlistMovies($watchlist->getId(), $page, $request->getLocale());
        $tmdbMovies = array_map(fn ($movie) => $movie->getTmdbDetailsData(), $movies);

        return $this->render('movies/watchlist/show.html.twig', [
            'watchlist' => $watchlist,
            'movies' => $tmdbMovies,
            'page' => $page,
            'maxPage' => $tmdbDataRepository->getMaxWatchlistPage($watchlist->getId(), $request->getLocale()),
        ]);
    }

    #[Route('/{_locale}/watchlists/{id}/delete', name: 'app_movie_watchlists_delete', methods: ['POST'])]
    public function deleteWatchlist(MovieWatchlist $watchlist, ToastService $toastService): Response
    {
        $user = $this->userProvider->authenticateUser();

        if (!$watchlist->hasOwner($user)) {
            throw $this->createAccessDeniedException();
        }

        $this->entityManager->remove($watchlist);
        $this->entityManager->flush();

        $toastService->addToast(new Toast(
            t('forms.delete_watchlist.success_message', ['watchlistName' => $watchlist->getName()]),
            ToastStyle::SUCCESS
        ));

        return $this->redirectToRoute('app_movie_watchlists');
    }
}
