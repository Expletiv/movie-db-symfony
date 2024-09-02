<?php

namespace App\Form\Admin;

use Locale;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TranslatableTextType extends AbstractType
{
    public function __construct(
        /**
         * @var string[]
         */
        #[Autowire(param: 'kernel.enabled_locales')]
        private readonly array $enabledLocales,
    ) {
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        foreach ($this->enabledLocales as $locale) {
            $builder->add($locale, TextType::class, [
                'label' => Locale::getDisplayName($locale),
            ]);
        }
    }
}
