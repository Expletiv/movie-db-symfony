<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class MovieDiscoverFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sortDirection', ChoiceType::class, [
                'choices' => [
                    'forms.movie.discover.sort.direction.desc' => 'desc',
                    'forms.movie.discover.sort.direction.asc' => 'asc',
                ],
                'label' => 'forms.movie.discover.sort.label.direction',
                'data' => 'desc',
            ])
            ->add('sortCategory', ChoiceType::class, [
                'choices' => [
                    'forms.movie.discover.sort.category.popularity' => 'popularity',
                    'forms.movie.discover.sort.category.revenue' => 'revenue',
                    'forms.movie.discover.sort.category.vote_average' => 'vote_average',
                    'forms.movie.discover.sort.category.vote_count' => 'vote_count',
                    'forms.movie.discover.sort.category.primary_release_date' => 'primary_release_date',
                    'forms.movie.discover.sort.category.title' => 'title',
                ],
                'label' => 'forms.movie.discover.sort.label.category',
                'data' => 'popularity',
            ])
            ->add('primaryReleaseYear', NumberType::class, [
                'label' => 'forms.movie.discover.sort.label.primary_release_year',
                'constraints' => [
                    new Range(min: 1800, max: 2100),
                ],
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'forms.movie.discover.sort.button',
            ])
            ->setMethod('GET');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'mapped' => false,
        ]);
    }
}
