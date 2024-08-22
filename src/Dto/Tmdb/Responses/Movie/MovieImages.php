<?php

namespace App\Dto\Tmdb\Responses\Movie;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class MovieImages
{
    /**
     * @var array<MovieImagesBackdrops>
     */
    #[SerializedName('backdrops')]
    private array $backdrops = [];
    #[SerializedName('id')]
    private ?int $id = null;
    /**
     * @var array<MovieImagesLogos>
     */
    #[SerializedName('logos')]
    private array $logos = [];
    /**
     * @var array<MovieImagesPosters>
     */
    #[SerializedName('posters')]
    private array $posters = [];

    /**
     * @return array<MovieImagesBackdrops>
     */
    public function getBackdrops(): array
    {
        return $this->backdrops;
    }

    /**
     * @param array<MovieImagesBackdrops> $backdrops
     */
    public function setBackdrops(array $backdrops): self
    {
        $this->backdrops = $backdrops;

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

    /**
     * @return array<MovieImagesLogos>
     */
    public function getLogos(): array
    {
        return $this->logos;
    }

    /**
     * @param array<MovieImagesLogos> $logos
     */
    public function setLogos(array $logos): self
    {
        $this->logos = $logos;

        return $this;
    }

    /**
     * @return array<MovieImagesPosters>
     */
    public function getPosters(): array
    {
        return $this->posters;
    }

    /**
     * @param array<MovieImagesPosters> $posters
     */
    public function setPosters(array $posters): self
    {
        $this->posters = $posters;

        return $this;
    }
}