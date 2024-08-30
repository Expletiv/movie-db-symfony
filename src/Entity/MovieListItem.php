<?php

namespace App\Entity;

use App\Repository\MovieListItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Sortable\Sortable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MovieListItemRepository::class)]
#[ORM\Index(columns: ['position'])]
#[ORM\UniqueConstraint(columns: ['movie_id', 'movie_list_id'])]
#[UniqueEntity(fields: ['movie', 'movieList'])]
class MovieListItem implements Sortable
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private int $id;

    #[Gedmo\SortablePosition]
    #[ORM\Column]
    private int $position = 1;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Movie $movie;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private MovieList $movieList;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function positionUp(): static
    {
        --$this->position;

        return $this;
    }

    public function positionDown(): static
    {
        ++$this->position;

        return $this;
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

    public function getMovieList(): MovieList
    {
        return $this->movieList;
    }

    public function setMovieList(MovieList $movieList): static
    {
        $this->movieList = $movieList;

        return $this;
    }

    public function __toString(): string
    {
        return $this->movie->getTitle();
    }
}
