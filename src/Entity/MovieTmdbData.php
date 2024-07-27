<?php

namespace App\Entity;

use App\Repository\MovieTmdbDataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MovieTmdbDataRepository::class)]
#[UniqueEntity(['movie', 'locale'])]
class MovieTmdbData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'tmdbData')]
    #[ORM\JoinColumn(nullable: false)]
    private Movie $movie;

    #[ORM\Column(length: 2)]
    #[Assert\Locale]
    private string $locale;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title;

    /**
     * @var array<string, mixed>
     */
    #[ORM\Column(type: Types::JSON)]
    private array $tmdbData;

    /**
     * @var array<string, mixed>
     */
    #[ORM\Column(type: Types::JSON)]
    private array $tmdbDetailsData;

    public function __construct()
    {
        $this->tmdbData = [];
        $this->tmdbDetailsData = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): static
    {
        $this->locale = $locale;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getTmdbDetailsData(): array
    {
        return $this->tmdbDetailsData;
    }

    public function setTmdbDetailsData(mixed $tmdbDetailsData): static
    {
        $this->tmdbDetailsData = $tmdbDetailsData;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getTmdbData(): array
    {
        return $this->tmdbData;
    }

    public function setTmdbData(mixed $tmdbData): static
    {
        $this->tmdbData = $tmdbData;

        return $this;
    }

    public function getTmdbDataJson(): string
    {
        return json_encode($this->tmdbData, JSON_PRETTY_PRINT);
    }

    public function getTmdbDetailsDataJson(): string
    {
        return json_encode($this->tmdbDetailsData, JSON_PRETTY_PRINT);
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }

    public function setMovie(Movie $movie): static
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function __toString(): string
    {
        return Languages::getName($this->locale);
    }
}
