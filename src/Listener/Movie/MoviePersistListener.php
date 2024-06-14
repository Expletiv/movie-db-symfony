<?php

namespace App\Listener\Movie;

use App\Entity\Movie;
use App\Message\MovieMessage;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsEntityListener(event: Events::postPersist, entity: Movie::class)]
readonly class MoviePersistListener
{
    public function __construct(
        private MessageBusInterface $messageBus,
    ) {
    }

    public function __invoke(Movie $movie, PostPersistEventArgs $eventArgs): void
    {
        $this->messageBus->dispatch(new MovieMessage($movie->getId()));
    }
}
