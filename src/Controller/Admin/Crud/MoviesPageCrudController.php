<?php

namespace App\Controller\Admin\Crud;

use App\Entity\MoviesPage;
use App\Enum\PageType;
use App\Form\Admin\EmbeddedCollectionField;
use App\Form\Admin\TranslatableTextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class MoviesPageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MoviesPage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('admin/form_theme/embedded_collection.html.twig')
            ->setEntityLabelInSingular('entity.movies_page.label.singular')
            ->setEntityLabelInPlural('entity.movies_page.label.plural')
            ->setDefaultSort(['id' => 'ASC']);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->setLabel('entity.movies_page.attributes.id')
            ->hideOnForm();

        yield ChoiceField::new('type')
            ->setLabel('entity.movies_page.attributes.type')
            ->setTranslatableChoices(PageType::getTranslatableChoices())
            ->renderAsBadges(PageType::getBadgeStyles())
            ->allowMultipleChoices(false);

        yield TranslatableTextField::new('title')
            ->setLabel('entity.movies_page.attributes.title');

        yield EmbeddedCollectionField::new('movie_lists')
            ->setLabel('entity.movies_page.attributes.movie_lists');
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DELETE)
            ->add(Crud::PAGE_EDIT, Action::INDEX);
    }
}
