<?php

namespace App\Entity;

use App\Entity\Interface\Sortable;
use App\Repository\MovieListItemRepository;
use App\Trait\SortableTrait;
use App\Validator\Constraints\HasValidPosition;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MovieListItemRepository::class)]
#[ORM\Index(columns: ['position'])]
#[ORM\UniqueConstraint(columns: ['movie_id', 'movie_list_id'])]
#[UniqueEntity(fields: ['movie', 'movieList'])]
#[HasValidPosition]
class MovieListItem implements Sortable
{
    use SortableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Movie $movie;

    #[Gedmo\SortableGroup]
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
