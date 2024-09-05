<?php

namespace App\Controller\Admin\Crud;

use App\Entity\MovieListItem;
use App\Trait\SortableCollectionTrait;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Contracts\Translation\TranslatorInterface;

class MovieListItemCrudController extends EmbeddedCollectionCrudController
{
    use SortableCollectionTrait;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly AdminUrlGenerator $adminUrlGenerator,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return MovieListItem::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular('entity.movie_list_item.label.singular')
            ->setEntityLabelInPlural('entity.movie_list_item.label.plural')
            ->setDefaultSort(['position' => 'ASC']);
    }

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
            ->setLabel(false)
            ->setRequired(false)
            ->setFormTypeOptions(['attr' => ['hidden' => true]])
            ->hideOnIndex();
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('movieList');
    }
}
