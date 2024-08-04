<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Entity\MovieWatchlist;
use App\Entity\User;
use App\Form\AddWatchlistType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WatchlistController extends AbstractController
{
    #[Route('/{_locale}/watchlists', name: 'app_movie_watchlists')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        /** @var User $user */
        $user = $this->getUser() ?? throw $this->createAccessDeniedException();

        $watchlists = $user->getMovieWatchlists();

        return $this->render('movies/watchlist/index.html.twig', [
            'watchlists' => $watchlists,
        ]);
    }

    #[Route('/{_locale}/watchlists/add', name: 'app_movie_watchlists_add')]
    public function addWatchlist(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        /** @var User $user */
        $user = $this->getUser() ?? throw $this->createAccessDeniedException();

        $form = $this->createForm(AddWatchlistType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var MovieWatchlist $movieWatchlist */
            $movieWatchlist = $form->getData();
            $movieWatchlist->setOwner($user);

            $entityManager->persist($movieWatchlist);
            $entityManager->flush();

            return $this->redirectToRoute('app_movie_watchlist_show', ['id' => $movieWatchlist->getId()]);
        }

        return $this->render('forms/add_watchlist.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{_locale}/watchlists/{id}', name: 'app_movie_watchlist_show')]
    public function showWatchlist(MovieWatchlist $watchlist): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        /** @var User $user */
        $user = $this->getUser() ?? throw $this->createAccessDeniedException();

        if ($watchlist->getOwner()->getId() !== $user->getId()) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('movies/watchlist/show.html.twig', [
            'watchlist' => $watchlist,
        ]);
    }
}
