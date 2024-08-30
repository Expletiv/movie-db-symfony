<?php

namespace App\Controller\Admin\Crud;

use App\Entity\MovieListItem;
use App\Repository\MovieListItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Contracts\Translation\TranslatorInterface;

class MovieListItemCrudController extends EmbeddedCollectionCrudController
{
    public function __construct(
        private readonly MovieListItemRepository $movieListItemRepository,
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
            ->setLabel('entity.movie_list_item.attributes.movie_list')
            ->hideOnIndex();
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(
                Crud::PAGE_INDEX,
                Action::new('moveUp')
                    ->setLabel(false)
                    ->setHtmlAttributes([
                        'title' => $this->translator->trans('entity.movie_list_item.actions.move_up'),
                        'onclick' => 'this.disabled = true; this.querySelector("i").classList.add("fa-spinner", "fa-spin");',
                    ])
                    ->addCssClass('btn btn-secondary')
                    ->setIcon('fa fa-arrow-up')
                    ->linkToCrudAction('moveUp')
                    ->displayIf(fn ($entity) => $entity->getPosition() > 1)
                    ->displayAsLink()
            )
            ->add(
                Crud::PAGE_INDEX,
                Action::new('moveDown')
                    ->setLabel(false)
                    ->setHtmlAttributes([
                        'title' => $this->translator->trans('entity.movie_list_item.actions.move_down'),
                        'onclick' => 'this.disabled = true; this.querySelector("i").classList.add("fa-spinner", "fa-spin");',
                    ])
                    ->addCssClass('btn btn-secondary')
                    ->setIcon('fa fa-arrow-down')
                    ->linkToCrudAction('moveDown')
                    ->displayIf(fn ($entity) => $entity->getPosition() < $this->movieListItemRepository->count(['movieList' => $entity->getMovieList()]))
                    ->displayAsLink()
            );
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('movieList');
    }

    public function moveUp(AdminContext $adminContext): Response
    {
        return $this->move($adminContext, fn (MovieListItem $item) => $item->positionUp());
    }

    public function moveDown(AdminContext $adminContext): Response
    {
        return $this->move($adminContext, function (MovieListItem $item) {
            if ($item->getPosition() >= $this->movieListItemRepository->count(['movieList' => $item->getMovieList()])) {
                return;
            }
            $item->positionDown();
        });
    }

    private function move(AdminContext $adminContext, callable $positionModifier): Response
    {
        $item = $adminContext->getEntity()->getInstance();

        if (!$item instanceof MovieListItem) {
            throw new BadRequestHttpException(sprintf('Item is not an instance of %s', MovieListItem::class));
        }

        $positionModifier($item);

        $this->entityManager->persist($item);
        $this->entityManager->flush();

        return $this->redirect($this->adminUrlGenerator->setAction(Action::INDEX)->generateUrl());
    }
}
