<?php

namespace App\Controller\Admin\Crud;

use App\Entity\MovieList;
use App\Form\Admin\EmbeddedCollectionField;
use App\Form\Admin\TranslatableTextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class MovieListCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MovieList::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('admin/form_theme/embedded_collection.html.twig')
            ->setEntityLabelInSingular('entity.movie_list.label.singular')
            ->setEntityLabelInPlural('entity.movie_list.label.plural');
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->setLabel('entity.movie_list.attributes.id')
            ->hideOnForm();

        yield TranslatableTextField::new('title')
            ->setLabel('entity.movie_list.attributes.title');

        yield EmbeddedCollectionField::new('movies')
            ->setLabel('entity.movie_list.attributes.movies');
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DELETE)
            ->add(Crud::PAGE_EDIT, Action::INDEX);
    }
}
