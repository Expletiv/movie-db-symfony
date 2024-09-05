<?php

namespace App\Trait;

use App\Entity\Interface\Sortable;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

trait SortableCollectionTrait
{
    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->add(
                Crud::PAGE_INDEX,
                Action::new('moveUp')
                    ->setLabel(false)
                    ->setHtmlAttributes([
                        'title' => $this->translator->trans('admin.sortable_collection.actions.move_up'),
                        'onclick' => 'this.disabled = true; this.querySelector("i").classList.add("fa-spinner", "fa-spin");',
                    ])
                    ->addCssClass('btn btn-secondary')
                    ->setIcon('fa fa-arrow-up')
                    ->linkToCrudAction('moveUp')
                    ->displayIf(fn (Sortable $entity) => $entity->getPosition() > 1)
                    ->displayAsLink()
            )
            ->add(
                Crud::PAGE_INDEX,
                Action::new('moveDown')
                    ->setLabel(false)
                    ->setHtmlAttributes([
                        'title' => $this->translator->trans('admin.sortable_collection.actions.move_down'),
                        'onclick' => 'this.disabled = true; this.querySelector("i").classList.add("fa-spinner", "fa-spin");',
                    ])
                    ->addCssClass('btn btn-secondary')
                    ->setIcon('fa fa-arrow-down')
                    ->linkToCrudAction('moveDown')
                    ->displayIf(fn (Sortable $entity) => !$this->isLastItem($entity))
                    ->displayAsLink()
            );
    }

    public function moveUp(AdminContext $adminContext): Response
    {
        return $this->move($adminContext, fn (Sortable $item) => $item->positionUp());
    }

    public function moveDown(AdminContext $adminContext): Response
    {
        return $this->move($adminContext, function (Sortable $item) {
            if ($this->isLastItem($item)) {
                return;
            }
            $item->positionDown();
        });
    }

    private function move(AdminContext $adminContext, callable $positionModifier): Response
    {
        $item = $adminContext->getEntity()->getInstance();

        if (!$item instanceof Sortable) {
            throw new BadRequestHttpException(sprintf('Item is not an instance of %s', Sortable::class));
        }

        $positionModifier($item);

        $this->entityManager->persist($item);
        $this->entityManager->flush();

        return $this->redirect($this->adminUrlGenerator->setAction(Action::INDEX)->generateUrl());
    }

    private function isLastItem(Sortable $item): bool
    {
        $repository = $this->container->get('doctrine')->getRepository($item::class);

        $groupName = $item->getSortableGroupName();
        $group = $item->getSortableGroup();

        if (null === $groupName || null === $group) {
            return false;
        }

        return $item->getPosition() >= $repository->count([$groupName => $group]);
    }
}
