<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvSeasonWatchProvidersResultsEC
{
    #[SerializedName('link')]
    private ?string $link = null;
    /**
     * @var array<TvSeasonWatchProvidersResultsECFlatrate>
     */
    #[SerializedName('flatrate')]
    private array $flatrate = [];

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return array<TvSeasonWatchProvidersResultsECFlatrate>
     */
    public function getFlatrate(): array
    {
        return $this->flatrate;
    }

    /**
     * @param array<TvSeasonWatchProvidersResultsECFlatrate> $flatrate
     */
    public function setFlatrate(array $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }
}