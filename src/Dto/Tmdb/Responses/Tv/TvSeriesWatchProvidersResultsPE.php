<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvSeriesWatchProvidersResultsPE
{
    #[SerializedName('link')]
    private ?string $link = null;
    /**
     * @var array<TvSeriesWatchProvidersResultsPEFlatrate>
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
     * @return array<TvSeriesWatchProvidersResultsPEFlatrate>
     */
    public function getFlatrate(): array
    {
        return $this->flatrate;
    }

    /**
     * @param array<TvSeriesWatchProvidersResultsPEFlatrate> $flatrate
     */
    public function setFlatrate(array $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }
}