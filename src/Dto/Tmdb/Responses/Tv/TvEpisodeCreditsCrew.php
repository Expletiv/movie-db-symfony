<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvEpisodeCreditsCrew
{
    #[SerializedName('department')]
    private ?string $department = null;
    #[SerializedName('job')]
    private ?string $job = null;
    #[SerializedName('credit_id')]
    private ?string $creditId = null;
    #[SerializedName('adult')]
    private ?bool $adult = null;
    #[SerializedName('gender')]
    private ?int $gender = null;
    #[SerializedName('id')]
    private ?int $id = null;
    #[SerializedName('known_for_department')]
    private ?string $knownForDepartment = null;
    #[SerializedName('name')]
    private ?string $name = null;
    #[SerializedName('original_name')]
    private ?string $originalName = null;
    #[SerializedName('popularity')]
    private ?float $popularity = null;
    #[SerializedName('profile_path')]
    private ?string $profilePath = null;

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getCreditId(): ?string
    {
        return $this->creditId;
    }

    public function setCreditId(?string $creditId): self
    {
        $this->creditId = $creditId;

        return $this;
    }

    public function getAdult(): ?bool
    {
        return $this->adult;
    }

    public function setAdult(?bool $adult): self
    {
        $this->adult = $adult;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(?int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getKnownForDepartment(): ?string
    {
        return $this->knownForDepartment;
    }

    public function setKnownForDepartment(?string $knownForDepartment): self
    {
        $this->knownForDepartment = $knownForDepartment;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): self
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    public function setPopularity(?float $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getProfilePath(): ?string
    {
        return $this->profilePath;
    }

    public function setProfilePath(?string $profilePath): self
    {
        $this->profilePath = $profilePath;

        return $this;
    }
}