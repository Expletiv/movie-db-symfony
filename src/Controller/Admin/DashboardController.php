<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/')]
    #[Route('/admin')]
    public function homepage(): RedirectResponse
    {
        return $this->redirectToRoute('admin');
    }

    #[Route('/admin/{_locale}', name: 'admin')]
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

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('dashboard.menu.section.movies');
    }
}
