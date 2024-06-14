<?php

namespace App\Listener\Movie;

use App\Entity\Movie;
use App\Message\MovieMessage;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsEntityListener(event: Events::preUpdate, entity: Movie::class)]
readonly class MovieUpdateListener
{
    public function __construct(
        private MessageBusInterface $messageBus,
    ) {
    }

    public function __invoke(Movie $movie, PreUpdateEventArgs $eventArgs): void
    {
        if ($eventArgs->hasChangedField('tmdbId')) {
            $this->messageBus->dispatch(new MovieMessage($movie->getId()));
        }
    }
}
