<?php

namespace App\Form\Watchlist;

use App\Entity\MovieWatchlist;
use App\Services\UserProvider;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class MovieWatchlistAutocompleteField extends AbstractType
{
    public function __construct(
        private readonly UserProvider $userProvider,
    ) {
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => MovieWatchlist::class,
            'placeholder' => 'forms.autocomplete.watchlist.placeholder',
            'filter_query' => function (QueryBuilder $qb, string $query) {
                $qb->andWhere('entity.name LIKE :query')
                    ->andWhere('entity.owner = :owner')
                    ->setParameter('query', '%'.$query.'%')
                    ->setParameter('owner', $this->userProvider->authenticateUser()->getId());
            },
            'security' => 'IS_AUTHENTICATED',
            'multiple' => true,
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}
