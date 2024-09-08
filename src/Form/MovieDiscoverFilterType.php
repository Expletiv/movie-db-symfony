<?php

namespace App\Form;

use App\Dto\Tmdb\TmdbClientInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class MovieDiscoverFilterType extends AbstractType
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly TmdbClientInterface $tmdbClient,
    ) {
    }

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
            ->add('primaryReleaseYear', IntegerType::class, [
                'label' => 'forms.movie.discover.primary_release_year.label',
                'constraints' => [
                    new Range(min: 1800, max: 2100),
                ],
                'required' => false,
            ])
            ->add('genres', ChoiceType::class, [
                'choice_loader' => new CallbackChoiceLoader(function (): array {
                    $response = $this->tmdbClient->genreApi()->genreMovieList(language: $this->requestStack->getCurrentRequest()->getLocale());

                    $mappedGenres = [];
                    foreach ($response->getGenres() as $genre) {
                        $mappedGenres[$genre->getName()] = $genre->getId();
                    }

                    return $mappedGenres;
                }),
                'autocomplete' => true,
                'multiple' => true,
                'required' => false,
                'label' => 'forms.movie.discover.genres.label',
            ])
            ->add('genreLogic', ChoiceType::class, [
                'choices' => [
                    'forms.movie.discover.genre_logic.choices.and' => ',',
                    'forms.movie.discover.genre_logic.choices.or' => '|',
                ],
                'label' => 'forms.movie.discover.genre_logic.label',
                'data' => ',',
                'multiple' => false,
                'expanded' => true,
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'forms.movie.discover.button',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'mapped' => false,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
