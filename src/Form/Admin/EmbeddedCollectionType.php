<?php

declare(strict_types=1);

namespace App\Form\Admin;

use Doctrine\ORM\PersistentCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Registry\CrudControllerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use InvalidArgumentException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmbeddedCollectionType extends AbstractType
{
    public const string OPTION_FILTER_NAME = 'filter_name';
    public const string OPTION_FILTER_VALUE = 'filter_value';
    public const string OPTION_FQCN = 'list_entity_fqcn';

    public function __construct(
        private readonly AdminUrlGenerator $adminUrlGenerator,
        private readonly CrudControllerRegistry $crudControllerRegistry,
    ) {
    }

    public function getBlockPrefix(): string
    {
        return 'embedded_collection';
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $filterName = $options[self::OPTION_FILTER_NAME];
        $filterValue = $options[self::OPTION_FILTER_VALUE];
        /** @var string $fqcn */
        $fqcn = $options[self::OPTION_FQCN];
        $mapped = $form->getConfig()->getMapped();

        if ($mapped) {
            $data = $form->getData();

            assert($data instanceof PersistentCollection);

            $filterName = $data->getMapping()['inversedBy'] ?? $data->getMapping()['mappedBy']
                ?? throw new InvalidArgumentException('Relationship was not found');

            $entity = $data->getOwner();

            if (null === $entity || !method_exists($entity, 'getId')) {
                throw new InvalidArgumentException('Entity or method getId() was not found');
            }

            $filterValue = $entity->getId();
            $fqcn = $data->getTypeClass()->getName();
        }

        $view->vars['embedded_collection_url'] = $this->adminUrlGenerator
            ->unsetAll()
            ->setController(
                $this->crudControllerRegistry->findCrudFqcnByEntityFqcn($fqcn)
                ?? throw new InvalidArgumentException('CrudController not found')
            )
            ->setAction(Action::INDEX)
            ->set('filters['.$filterName.'][comparison]', '=')
            ->set('filters['.$filterName.'][value]', $filterValue)
            ->generateUrl();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            self::OPTION_FILTER_NAME => null,
            self::OPTION_FILTER_VALUE => null,
            self::OPTION_FQCN => null,
        ]);

        $resolver->setAllowedTypes(self::OPTION_FILTER_NAME, ['string', 'null']);
        $resolver->setAllowedTypes(self::OPTION_FILTER_VALUE, ['string', 'int', 'null']);
        $resolver->setAllowedTypes(self::OPTION_FQCN, ['string', 'null']);
    }
}
