<?php

namespace App\Dto\Tmdb\Responses\Collection;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class CollectionImages
{
    #[SerializedName('id')]
    private ?int $id = null;
    /**
     * @var array<CollectionImagesBackdrops>
     */
    #[SerializedName('backdrops')]
    private array $backdrops = [];
    /**
     * @var array<CollectionImagesPosters>
     */
    #[SerializedName('posters')]
    private array $posters = [];

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
     * @return array<CollectionImagesBackdrops>
     */
    public function getBackdrops(): array
    {
        return $this->backdrops;
    }

    /**
     * @param array<CollectionImagesBackdrops> $backdrops
     */
    public function setBackdrops(array $backdrops): self
    {
        $this->backdrops = $backdrops;

        return $this;
    }

    /**
     * @return array<CollectionImagesPosters>
     */
    public function getPosters(): array
    {
        return $this->posters;
    }

    /**
     * @param array<CollectionImagesPosters> $posters
     */
    public function setPosters(array $posters): self
    {
        $this->posters = $posters;

        return $this;
    }
}