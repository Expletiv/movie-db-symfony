<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class AddToWatchlistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('watchlist', MovieWatchlistAutocompleteField::class, [
                'label' => 'forms.watchlist.movie.add.choose_watchlist',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'forms.watchlist.movie.add.action',
            ]);
    }
}
