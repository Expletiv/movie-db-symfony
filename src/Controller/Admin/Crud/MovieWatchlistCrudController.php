<?php

namespace App\Controller\Admin\Crud;

use App\Entity\MovieWatchlist;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MovieWatchlistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MovieWatchlist::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('entity.movie_watchlist.label.singular')
            ->setEntityLabelInPlural('entity.movie_watchlist.label.plural');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnIndex()
            ->setDisabled()
            ->setLabel('entity.movie_watchlist.attributes.id');

        yield TextField::new('name')
            ->setLabel('entity.movie_watchlist.attributes.name');

        yield AssociationField::new('owner')
            ->setLabel('entity.movie_watchlist.attributes.owner');

        yield CollectionField::new('movies')
            ->setLabel('entity.movie_watchlist.attributes.movies')
            ->hideOnIndex()
            ->setTemplatePath('admin/util/linked_collection.html.twig')
            ->setCustomOptions([
                'collectionCrudControllerFqcn' => MovieCrudController::class,
            ])
            ->allowAdd()
            ->allowDelete()
            ->setEntryIsComplex()
            ->useEntryCrudForm(MovieCrudController::class)
            // by_reference option being set to false causes the entire collection to be replaced
            // which removes all existing entries and adds the new ones
            ->setFormTypeOptions([
                'by_reference' => true,
            ]);
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DELETE);
    }
}
