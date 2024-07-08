<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

abstract class DefaultCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDateTimeFormat('d.m.Y');
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addWebpackEncoreEntry('admin');
    }
}
