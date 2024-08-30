<?php

namespace App\Form\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Symfony\Contracts\Translation\TranslatableInterface;

class EmbeddedCollectionField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, TranslatableInterface|string|false|null $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplatePath('admin/util/embedded_collection.html.twig')
            ->setFormType(EmbeddedCollectionType::class)
            ->setColumns('col-12')
            ->hideOnIndex()
            ->hideWhenCreating()
            ->hideOnDetail(); // TODO: Implement embedded lists on detail page
    }

    public function setCustomList(string $filterName, string|int $filterValue, string $fqcn): self
    {
        $this->setFormTypeOptions([
            'mapped' => false,
            EmbeddedCollectionType::OPTION_FILTER_NAME => $filterName,
            EmbeddedCollectionType::OPTION_FILTER_VALUE => $filterValue,
            EmbeddedCollectionType::OPTION_FQCN => $fqcn,
        ]);

        return $this;
    }
}
