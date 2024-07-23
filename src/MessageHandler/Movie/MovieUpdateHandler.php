<?php

namespace App\MessageHandler\Movie;

use App\Hydrator\Movie\MovieHydrator;
use App\Message\Movie\MovieUpdateMessage;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class MovieUpdateHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MovieRepository $movieRepository,
        private MovieHydrator $movieHydrator,
    ) {
    }

    public function __invoke(MovieUpdateMessage $message): void
    {
        $movie = $this->movieRepository->find($message->getId());

        if (!$movie) {
            return;
        }
        $this->movieHydrator->hydrateWithEnabledLocales($movie);

        $this->entityManager->persist($movie);
        $this->entityManager->flush();
    }
}
