<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MovieCrudController extends DefaultCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('movie.label.singular')
            ->setEntityLabelInPlural('movie.label.plural')
            ->renderContentMaximized();
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();

        yield IdField::new('tmdbId')
        ->setFormTypeOptions(
            [
                'autocomplete' => 'true',
                'autocomplete_url' => '/movie-autocomplete',
                'attr' => [
                    'data-controller' => 'symfony/ux-autocomplete/autocomplete',
                ],
                'tom_select_options' => [
                    'maxItems' => 1,
                ],
            ]
        );

        yield TextField::new('title')
            ->setLabel('movie.attributes.title')
            ->setRequired(false)
            ->setDisabled();

        yield DateField::new('releaseDate')
            ->setLabel('movie.attributes.release_date')
            ->setRequired(false)
            ->setDisabled();

        yield IntegerField::new('likes')
            ->setLabel('movie.attributes.likes')
            ->setRequired(false);

        yield CodeEditorField::new('tmdbDataJson')
            ->onlyOnDetail();

        yield CodeEditorField::new('tmdbDetailsDataJson')
            ->onlyOnDetail();
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DELETE);
    }
}
