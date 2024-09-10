<?php

namespace App\Entity;

use App\Entity\Interface\Sortable;
use App\Repository\MoviesPageListRepository;
use App\Trait\SortableTrait;
use App\Validator\Constraints\HasValidPosition;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MoviesPageListRepository::class)]
#[ORM\Index(columns: ['position'])]
#[ORM\UniqueConstraint(columns: ['page_id', 'list_id'])]
#[UniqueEntity(fields: ['list', 'page'])]
#[HasValidPosition]
class MoviesPageList implements Sortable
{
    use SortableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(inversedBy: 'movieLists')]
    #[ORM\JoinColumn(nullable: false)]
    #[Gedmo\SortableGroup]
    private MoviesPage $page;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private MovieList $list;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getPage(): MoviesPage
    {
        return $this->page;
    }

    public function setPage(MoviesPage $page): static
    {
        $this->page = $page;

        return $this;
    }

    public function getList(): MovieList
    {
        return $this->list;
    }

    public function setList(MovieList $list): static
    {
        $this->list = $list;

        return $this;
    }
}
