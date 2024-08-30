<?php

namespace App\Controller\Admin\Crud;

use App\Entity\MovieListItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Component\HttpFoundation\RequestStack;

class MovieListItemCrudController extends AbstractCrudController
{
    public function __construct(
        private readonly RequestStack $requestStack,
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return MovieListItem::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->overrideTemplates([
                'crud/index' => 'admin/crud/turbo_frame/index.html.twig',
                'crud/new' => 'admin/crud/turbo_frame/new.html.twig',
            ])
            ->setFormOptions([
                'attr' => ['action' => $this->requestStack->getCurrentRequest()->getRequestUri()],
            ])
            ->showEntityActionsInlined()
            ->setEntityLabelInSingular('entity.movie_list_item.label.singular')
            ->setEntityLabelInPlural('entity.movie_list_item.label.plural');
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->setLabel('entity.movie_list_item.attributes.id')
            ->hideOnForm();

        yield AssociationField::new('movie')
            ->setLabel('entity.movie_list_item.attributes.movie');

        yield IntegerField::new('position')
            ->setLabel('entity.movie_list_item.attributes.position')
            ->setEmptyData(1)
            ->setRequired(false);

        yield AssociationField::new('movieList')
            ->setLabel('entity.movie_list_item.attributes.movie_list')
            ->hideOnIndex();
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->add(Crud::PAGE_NEW, Action::INDEX);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('movieList');
    }
}
