<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Dto\Tmdb\Responses\Movie\MovieDetails;
use App\Entity\MoviesPageList;
use App\Enum\PageType;
use App\Repository\MoviesPageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class HomeController extends AbstractController
{
    #[Route('/{_locale}/home')]
    public function index(
        Request $request,
        DenormalizerInterface $denormalizer,
        MoviesPageRepository $moviesPageRepository,
    ): Response {
        $page = $moviesPageRepository->findOneBy(['type' => PageType::HOME]);

        if (null === $page) {
            $this->redirectToRoute('app_movies_popular', ['_locale' => $request->getLocale()]);
        }

        $lists = $page->getMovieLists()->map(static function (MoviesPageList $movieList) use ($denormalizer, $request): array {
            $list = $movieList->getList();

            $tmdbMovies = [];
            foreach ($list->getMovies() as $movie) {
                $tmdbData = $movie->getMovie()->getTmdbDataForLocale($request->getLocale());
                if (null === $tmdbData) {
                    continue;
                }
                $tmdbMovies[] = $denormalizer->denormalize($tmdbData->getTmdbDetailsData(), MovieDetails::class);
            }

            return [
                'title' => $list->getTitleForLocale($request->getLocale()),
                'results' => $tmdbMovies,
            ];
        });

        $page = [
            'title' => $page->getTitleForLocale($request->getLocale()),
            'lists' => $lists,
        ];

        return $this->render('home/index.html.twig', [
            'page' => $page,
        ]);
    }

    #[Route('/')]
    public function indexNoLocale(): RedirectResponse
    {
        return $this->redirectToRoute('app_frontend_home_index', ['_locale' => 'en']);
    }
}
