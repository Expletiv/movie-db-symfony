<?php

namespace App\Entity;

use App\Repository\MovieListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MovieListRepository::class)]
class MovieList
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $title;

    /**
     * @var Collection<int, MovieListItem>
     */
    #[ORM\OneToMany(
        targetEntity: MovieListItem::class,
        mappedBy: 'movieList',
        cascade: ['persist', 'remove'],
        orphanRemoval: true,
    )]
    #[Assert\Valid]
    private Collection $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, MovieListItem>
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(MovieListItem $movie): static
    {
        if (!$this->movies->contains($movie)) {
            $this->movies->add($movie);
            $movie->setMovieList($this);
        }

        return $this;
    }

    public function removeMovie(MovieListItem $movie): static
    {
        $this->movies->removeElement($movie);

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
