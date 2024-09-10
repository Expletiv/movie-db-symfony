<?php

namespace App\Entity;

use App\Enum\PageType;
use App\Repository\MoviesPageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MoviesPageRepository::class)]
#[UniqueEntity(fields: ['type'])]
class MoviesPage
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: Types::STRING, unique: true, enumType: PageType::class)]
    private PageType $type;

    /**
     * @var array<string, string> $title
     */
    #[ORM\Column(type: Types::JSON, options: ['jsonb' => true])]
    private array $title;

    /**
     * @var Collection<int, MoviesPageList>
     */
    #[ORM\OneToMany(
        targetEntity: MoviesPageList::class,
        mappedBy: 'page',
        cascade: ['persist', 'remove'],
        orphanRemoval: true
    )]
    #[ORM\OrderBy(['position' => 'ASC'])]
    #[Assert\Valid]
    private Collection $movieLists;

    public function __construct()
    {
        $this->movieLists = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getType(): string
    {
        return $this->type->value;
    }

    public function getTypeEnum(): PageType
    {
        return $this->type;
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function setType(PageType|string $type): static
    {
        if (is_string($type)) {
            $type = PageType::tryFrom($type);

            if (null === $type) {
                throw new InvalidArgumentException(sprintf('Invalid page type: %s', $type));
            }
        }
        $this->type = $type;

        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function getTitle(): array
    {
        return $this->title;
    }

    /**
     * @param array<string, string> $title
     */
    public function setTitle(array $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getTitleForLocale(string $locale): ?string
    {
        return $this->title[$locale] ?? null;
    }

    public function setTitleForLocale(string $locale, string $title): static
    {
        $this->title[$locale] = $title;

        return $this;
    }

    /**
     * @return Collection<int, MoviesPageList>
     */
    public function getMovieLists(): Collection
    {
        return $this->movieLists;
    }

    public function addMovieList(MoviesPageList $movieList): static
    {
        if (!$this->movieLists->contains($movieList)) {
            $this->movieLists->add($movieList);
            $movieList->setPage($this);
        }

        return $this;
    }

    public function removeMovieList(MoviesPageList $movieList): static
    {
        $this->movieLists->removeElement($movieList);

        return $this;
    }

    public function __toString(): string
    {
        return $this->title['en'] ?? 'MoviesPage#'.$this->id;
    }
}
