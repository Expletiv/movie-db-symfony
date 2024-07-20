<?php

namespace App\MessageHandler\Movie;

use App\Hydrator\Movie\MovieHydrator;
use App\Message\Movie\MovieBatchHydrationMessage;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Twig\Environment;

use function Symfony\Component\Translation\t;

#[AsMessageHandler]
readonly class MovieBatchHydrationHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private MovieRepository $movieRepository,
        private MovieHydrator $movieHydrator,
        private HubInterface $hub,
        private Environment $twig,
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(MovieBatchHydrationMessage $message): void
    {
        $movies = $this->movieRepository->findAll();
        $count = count($movies);

        foreach ($movies as $i => $movie) {
            $this->movieHydrator->hydrate($movie);
            $this->entityManager->persist($movie);

            $this->publishProgress((int) (($i + 1) / $count * 100));
        }

        $this->entityManager->flush();
    }

    private function publishProgress(int $percentage): void
    {
        try {
            $this->hub->publish(
                new Update(
                    'hydrationProgress',
                    $this->twig->render('admin/notification/progress_bar.html.twig', [
                        'percentage' => $percentage,
                        'message' => t('movie.actions.movie_hydrate'),
                        'target' => 'hydrationProgress',
                    ])
                )
            );
        } catch (Exception $e) {
            $this->logger->error(sprintf(
                'unable to publish hydration progess, error message: %s',
                $e->getMessage(),
            ), ['exception' => $e]);
        }
    }
}
