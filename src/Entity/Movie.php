<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ORM\UniqueConstraint(name: 'movie_unique_idx', columns: ['tmdb_id'])]
#[ORM\Index(name: 'movie_popularity_idx', columns: ['popularity'])]
#[UniqueEntity('tmdbId')]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    #[Assert\Positive]
    private int $tmdbId;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $releaseDate;

    #[ORM\Column]
    private float $popularity = -1;

    #[ORM\Column]
    #[Assert\PositiveOrZero]
    private int $likes = 0;

    /**
     * @var Collection<int, MovieTmdbData>
     */
    #[ORM\OneToMany(
        targetEntity: MovieTmdbData::class,
        mappedBy: 'movie',
        cascade: ['persist'],
        orphanRemoval: true
    )]
    #[Assert\Valid]
    private Collection $tmdbData;

    /**
     * @var Collection<int, MovieWatchlist>
     */
    #[ORM\ManyToMany(targetEntity: MovieWatchlist::class, mappedBy: 'movies')]
    private Collection $watchlists;

    public function __construct()
    {
        $this->tmdbData = new ArrayCollection();
        $this->watchlists = new ArrayCollection();
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

    public function getTitle(?string $locale = null): ?string
    {
        if (null === $locale) {
            return $this->title;
        }

        return $this->getTmdbDataForLocale($locale)?->getTitle();
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(DateTimeImmutable $releaseDate): static
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
     * @return Collection<int, MovieTmdbData>
     */
    public function getTmdbData(): Collection
    {
        return $this->tmdbData;
    }

    /**
     * @param Collection<int, MovieTmdbData> $tmdbData
     */
    public function setTmdbData(Collection $tmdbData): static
    {
        $this->tmdbData = $tmdbData;

        return $this;
    }

    public function addTmdbDatum(MovieTmdbData $tmdbData): static
    {
        if (!$this->hasLocale($tmdbData)) {
            $this->tmdbData->add($tmdbData);
            $tmdbData->setMovie($this);
        }

        return $this;
    }

    public function hasLocale(string $locale): bool
    {
        return null !== $this->getTmdbDataForLocale($locale);
    }

    public function removeTmdbDatum(MovieTmdbData $tmdbData): static
    {
        $this->tmdbData->removeElement($tmdbData);

        return $this;
    }

    public function getTmdbDataForLocale(string $locale): ?MovieTmdbData
    {
        return $this->tmdbData->findFirst(
            fn ($i, $tmdbData) => $tmdbData->getMovie() === $this && $tmdbData->getLocale() === $locale
        );
    }

    /**
     * @return Collection<int, MovieWatchlist>
     */
    public function getWatchlists(): Collection
    {
        return $this->watchlists;
    }

    public function addToWatchlist(MovieWatchlist $watchlist): static
    {
        if (!$this->watchlists->contains($watchlist)) {
            $this->watchlists->add($watchlist);
            $watchlist->addMovie($this);
        }

        return $this;
    }

    public function removeFromWatchlist(MovieWatchlist $watchlist): static
    {
        if ($this->watchlists->removeElement($watchlist)) {
            $watchlist->removeMovie($this);
        }

        return $this;
    }

    // for EasyAdmin to display on autocomplete forms
    public function __toString(): string
    {
        return $this->title ?? $this->tmdbId;
    }
}
