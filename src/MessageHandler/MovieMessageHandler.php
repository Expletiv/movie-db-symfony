<?php

namespace App\MessageHandler;

use App\Hydrator\Movie\MovieHydrator;
use App\Message\MovieMessage;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class MovieMessageHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MovieRepository $movieRepository,
        private MovieHydrator $movieHydrator,
    ) {
    }

    public function __invoke(MovieMessage $message): void
    {
        $movie = $this->movieRepository->find($message->getId());

        if (!$movie) {
            return;
        }
        $this->movieHydrator->hydrate($movie);

        $this->entityManager->persist($movie);
        $this->entityManager->flush();
    }
}
