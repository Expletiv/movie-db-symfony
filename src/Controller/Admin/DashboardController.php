<?php

namespace App\Controller\Admin;

use App\Entity\EmailLog;
use App\Entity\Movie;
use App\Entity\MovieList;
use App\Entity\MovieTmdbData;
use App\Entity\MovieWatchlist;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin')]
    public function homepage(): RedirectResponse
    {
        return $this->redirectToRoute('app_admin_dashboard_index');
    }

    #[Route('/{_locale}/admin')]
    public function homepageLocaleFirst(): RedirectResponse
    {
        return $this->redirectToRoute('app_admin_dashboard_index');
    }

    #[Route('/admin/{_locale}', name: 'app_admin_dashboard_index')]
    public function index(): Response
    {
        return $this->render('admin/dashboard/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Backend CMS')
            ->setLocales(['de', 'en']);
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateFormat('d.M.Y');
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addWebpackEncoreEntry('admin');
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('admin.dashboard.menu.section.movies');
        yield MenuItem::linkToCrud(
            'entity.movie.label.plural',
            'fa fa-solid fa-film',
            Movie::class
        );
        yield MenuItem::linkToCrud(
            'entity.movie_tmdb_data.label.plural',
            'fa fa-solid fa-film',
            MovieTmdbData::class
        );
        yield MenuItem::linkToCrud(
            'entity.movie_watchlist.label.plural',
            'fa fa-solid fa-list',
            MovieWatchlist::class
        );
        yield MenuItem::linkToCrud(
            'entity.movie_list.label.plural',
            'fa fa-solid fa-list',
            MovieList::class
        );

        yield MenuItem::section('admin.dashboard.menu.section.users');
        yield MenuItem::linkToCrud(
            'entity.user.label.plural',
            'fa fa-solid fa-users',
            User::class
        );
        yield MenuItem::linkToCrud(
            'entity.email_log.label.plural',
            'fa fa-solid fa-envelope',
            EmailLog::class
        );
    }
}
