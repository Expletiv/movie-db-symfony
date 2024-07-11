<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[UniqueEntity('tmdbId')]
#[ORM\Index(name: 'popularity_idx', columns: ['popularity'])]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(unique: true)]
    #[Assert\Positive]
    private int $tmdbId;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $releaseDate;

    #[ORM\Column]
    private float $popularity = -1;

    #[ORM\Column]
    #[Assert\PositiveOrZero]
    private int $likes = 0;

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

    public function getTmdbId(): int
    {
        return $this->tmdbId;
    }

    public function setTmdbId(int $tmdbId): static
    {
        $this->tmdbId = $tmdbId;

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

    public function getReleaseDate(): ?\DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeImmutable $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getPopularity(): float
    {
        return $this->popularity;
    }

    public function setPopularity(float $popularity): Movie
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getLikes(): int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): static
    {
        $this->likes = $likes;

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
        return json_encode($this->tmdbData);
    }

    public function getTmdbDetailsDataJson(): string
    {
        return json_encode($this->tmdbDetailsData, JSON_PRETTY_PRINT);
    }
}
