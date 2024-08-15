<?php

namespace App\Controller\Admin\Crud;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('entity.user.label.singular')
            ->setEntityLabelInPlural('entity.user.label.plural');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->setDisabled()
            ->setLabel('entity.user.attributes.id');

        yield EmailField::new('email')
            ->setLabel('entity.user.attributes.email');

        yield ArrayField::new('roles')
            ->setLabel('entity.user.attributes.roles');

        yield BooleanField::new('verified')
            ->setLabel('entity.user.attributes.verified')
            ->renderAsSwitch(false);

        yield CollectionField::new('movieWatchlists')
            ->setLabel('entity.user.attributes.movie_watchlists')
            ->hideOnIndex()
            ->setTemplatePath('admin/util/linked_collection.html.twig')
            ->setCustomOptions([
                'collectionCrudControllerFqcn' => MovieWatchlistCrudController::class,
            ])
            ->allowAdd()
            ->allowDelete()
            ->setEntryIsComplex()
            ->useEntryCrudForm(MovieWatchlistCrudController::class)
            // by_reference option being set to false causes the entire collection to be replaced
            // which removes all existing entries and adds the new ones
            ->setFormTypeOptions([
                'by_reference' => true,
            ]);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DELETE)
            ->remove(Crud::PAGE_INDEX, Action::NEW);
    }
}
