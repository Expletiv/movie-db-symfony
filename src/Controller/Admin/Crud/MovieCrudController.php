<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Movie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MovieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('entity.movie.label.singular')
            ->setEntityLabelInPlural('entity.movie.label.plural')
            ->setDefaultSort([
                'id' => 'ASC',
            ])
            ->renderContentMaximized()
            ->overrideTemplates([
                'crud/index' => '/admin/crud/movie/popular.html.twig',
            ]);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();

        yield IdField::new('tmdbId')
            ->setLabel('entity.movie.attributes.tmdb_id')
            ->setFormTypeOptions(
                [
                    'autocomplete' => 'true',
                    'autocomplete_url' => $this->generateUrl('app_movie_autocomplete'),
                    'attr' => [
                        'data-controller' => 'symfony/ux-autocomplete/autocomplete',
                    ],
                    'tom_select_options' => [
                        'maxItems' => 1,
                    ],
                ]
            );

        yield TextField::new('title')
            ->setLabel('entity.movie.attributes.title')
            ->setRequired(false)
            ->setDisabled();

        yield DateField::new('releaseDate')
            ->setLabel('entity.movie.attributes.release_date')
            ->setRequired(false)
            ->setDisabled();

        yield NumberField::new('popularity')
            ->setLabel('entity.movie.attributes.popularity')
            ->setRequired(false)
            ->setDisabled();

        yield IntegerField::new('likes')
            ->setLabel('entity.movie.attributes.likes')
            ->setRequired(false);

        yield CollectionField::new('tmdbData')
            ->setLabel('entity.movie.attributes.tmdb_data')
            ->setTemplatePath('admin/util/linked_collection.html.twig')
            ->setCustomOptions([
                'collectionCrudControllerFqcn' => MovieTmdbDataCrudController::class,
            ])
            ->allowAdd()
            ->allowDelete()
            ->renderExpanded()
            ->setEntryIsComplex()
            ->useEntryCrudForm(MovieTmdbDataCrudController::class);
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DELETE);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('tmdbId')
            ->add('title')
            ->add('popularity')
            ->add('releaseDate')
            ->add('likes');
    }
}
