<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvSeriesWatchProvidersResultsGB
{
    #[SerializedName('link')]
    private ?string $link = null;
    /**
     * @var array<TvSeriesWatchProvidersResultsGBFlatrate>
     */
    #[SerializedName('flatrate')]
    private array $flatrate = [];
    /**
     * @var array<TvSeriesWatchProvidersResultsGBBuy>
     */
    #[SerializedName('buy')]
    private array $buy = [];

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
     * @return array<TvSeriesWatchProvidersResultsGBFlatrate>
     */
    public function getFlatrate(): array
    {
        return $this->flatrate;
    }

    /**
     * @param array<TvSeriesWatchProvidersResultsGBFlatrate> $flatrate
     */
    public function setFlatrate(array $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }

    /**
     * @return array<TvSeriesWatchProvidersResultsGBBuy>
     */
    public function getBuy(): array
    {
        return $this->buy;
    }

    /**
     * @param array<TvSeriesWatchProvidersResultsGBBuy> $buy
     */
    public function setBuy(array $buy): self
    {
        $this->buy = $buy;

        return $this;
    }
}