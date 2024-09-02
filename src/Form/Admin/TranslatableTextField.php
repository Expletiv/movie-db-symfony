<?php

namespace App\Form\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use LogicException;
use Symfony\Contracts\Translation\TranslatableInterface;

class TranslatableTextField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, TranslatableInterface|string|false|null $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->setTemplatePath('admin/util/translatable_text.html.twig')
            ->formatValue(function (array $value): string {
                return $value['en'] ?? throw new LogicException('No data found for the default locale \'en\'.');
            })
            ->setFormType(TranslatableTextType::class);
    }
}
