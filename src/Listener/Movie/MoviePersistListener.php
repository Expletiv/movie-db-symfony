<?php

namespace App\Listener\Movie;

use App\Entity\Movie;
use App\Hydrator\Movie\MovieHydrator;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: Movie::class)]
readonly class MoviePersistListener
{
    public function __construct(
        private MovieHydrator $hydrator,
    ) {
    }

    public function __invoke(Movie $movie, PrePersistEventArgs $eventArgs): void
    {
        $movie->setTmdbData([]);
        $movie->setTmdbDetailsData([]);
        $this->hydrator->hydrate($movie);
    }
}
