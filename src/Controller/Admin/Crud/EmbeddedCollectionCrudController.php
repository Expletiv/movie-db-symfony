<?php

namespace App\Controller\Admin\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

abstract class EmbeddedCollectionCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->overrideTemplates([
                'crud/index' => 'admin/crud/turbo_frame/index.html.twig',
                'crud/new' => 'admin/crud/turbo_frame/new.html.twig',
            ])
            ->setFormOptions([
                'attr' => ['action' => $this->container->get('request_stack')->getCurrentRequest()->getRequestUri()],
            ])
            ->showEntityActionsInlined();
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->add(Crud::PAGE_NEW, Action::INDEX);
    }
}
