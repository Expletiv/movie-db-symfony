<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'entity.user.validators.email_validation')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 180, unique: true)]
    private string $email;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private string $password;

    #[ORM\Column]
    private bool $isVerified = false;

    /**
     * @var Collection<int, MovieWatchlist>
     */
    #[ORM\OneToMany(targetEntity: MovieWatchlist::class, mappedBy: 'owner', orphanRemoval: true)]
    private Collection $movieWatchlists;

    public function __construct()
    {
        $this->movieWatchlists = new ArrayCollection();
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return list<string>
     *
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, MovieWatchlist>
     */
    public function getMovieWatchlists(): Collection
    {
        return $this->movieWatchlists;
    }

    public function addMovieWatchlist(MovieWatchlist $movieWatchlist): static
    {
        if (!$this->movieWatchlists->contains($movieWatchlist)) {
            $this->movieWatchlists->add($movieWatchlist);
            $movieWatchlist->setOwner($this);
        }

        return $this;
    }

    public function removeMovieWatchlist(MovieWatchlist $movieWatchlist): static
    {
        $this->movieWatchlists->removeElement($movieWatchlist);

        return $this;
    }

    /**
     * @param iterable<MovieWatchlist> $watchlists
     */
    public function ownsWatchlists(iterable $watchlists): bool
    {
        foreach ($watchlists as $watchlist) {
            if (!$watchlist->hasOwner($this)) {
                return false;
            }
        }

        return true;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
