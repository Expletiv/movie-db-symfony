<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvEpisodeImages
{
    #[SerializedName('id')]
    private ?int $id = null;
    /**
     * @var array<TvEpisodeImagesStills>
     */
    #[SerializedName('stills')]
    private array $stills = [];

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
     * @return array<TvEpisodeImagesStills>
     */
    public function getStills(): array
    {
        return $this->stills;
    }

    /**
     * @param array<TvEpisodeImagesStills> $stills
     */
    public function setStills(array $stills): self
    {
        $this->stills = $stills;

        return $this;
    }
}