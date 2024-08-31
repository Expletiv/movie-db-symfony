<?php

namespace App\Controller\Admin\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class EmbeddedCollectionCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->overrideTemplates([
                'crud/index' => 'admin/crud/turbo_frame/index.html.twig',
                'crud/new' => 'admin/crud/turbo_frame/new.html.twig',
            ])
            ->setFormOptions([
                'attr' => ['action' => $this->container->get('request_stack')->getCurrentRequest()->getRequestUri()],
            ])
            ->showEntityActionsInlined();
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->add(Crud::PAGE_NEW, Action::INDEX);
    }

    public function new(AdminContext $context)
    {
        $queryParams = $context->getRequest()->query->all();
        $filters = $queryParams['filters'] ?? [];

        // Find the parent filter
        $parentFilterKey = null;
        $parentFilterValue = null;
        foreach ($filters as $field => $filter) {
            if (isset($filter['comparison']) && '=' === $filter['comparison']) {
                $parentFilterKey = $field;
                $parentFilterValue = $filter['value'];
                break;
            }
        }

        if (null === $parentFilterKey || null === $parentFilterValue) {
            throw new BadRequestHttpException('The parent entity filter is missing.');
        }

        $entityFqcn = $context->getCrud()->getEntityFqcn();

        $entityClassName = substr($entityFqcn, strrpos($entityFqcn, '\\') + 1);

        $userInput = $context->getRequest()->request->all($entityClassName);
        if (!empty($userInput) && isset($userInput[$parentFilterKey])) {
            $userInput[$parentFilterKey] = $parentFilterValue;
            $context->getRequest()->request->set($entityClassName, $userInput);
        }

        return parent::new($context);
    }
}
