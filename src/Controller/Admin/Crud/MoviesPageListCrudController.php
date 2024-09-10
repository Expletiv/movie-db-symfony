<?php

namespace App\Controller\Admin\Crud;

use App\Entity\MoviesPageList;
use App\Trait\SortableCollectionTrait;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Contracts\Translation\TranslatorInterface;

class MoviesPageListCrudController extends EmbeddedCollectionCrudController
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
        return MoviesPageList::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular('entity.movies_page_list.label.singular')
            ->setEntityLabelInPlural('entity.movies_page_list.label.plural')
            ->setDefaultSort(['position' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->setLabel('entity.movies_page_list.attributes.id')
            ->hideOnForm();

        yield AssociationField::new('list')
            ->setLabel('entity.movies_page_list.attributes.list');

        yield IntegerField::new('position')
            ->setLabel('entity.movies_page_list.attributes.position')
            ->setEmptyData(0)
            ->setHelp('admin.sortable_collection.position_help')
            ->setRequired(false);

        yield AssociationField::new('page')
            ->setLabel(false)
            ->setRequired(false)
            ->setFormTypeOptions(['attr' => ['hidden' => true]])
            ->hideOnIndex();
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('page');
    }
}
