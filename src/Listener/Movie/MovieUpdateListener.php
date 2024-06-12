<?php

namespace App\Listener\Movie;

use App\Entity\Movie;
use App\Hydrator\Movie\MovieHydrator;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::preUpdate, entity: Movie::class)]
readonly class MovieUpdateListener
{
    public function __construct(
        private MovieHydrator $hydrator,
    ) {
    }

    public function __invoke(Movie $movie, PreUpdateEventArgs $eventArgs): void
    {
        if ($eventArgs->hasChangedField('tmdbId')) {
            $this->hydrator->hydrate($movie);
        }
    }
}
