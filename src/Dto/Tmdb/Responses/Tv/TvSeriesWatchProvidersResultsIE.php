<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvSeriesWatchProvidersResultsIE
{
    #[SerializedName('link')]
    private ?string $link = null;
    /**
     * @var array<TvSeriesWatchProvidersResultsIEFlatrate>
     */
    #[SerializedName('flatrate')]
    private array $flatrate = [];
    /**
     * @var array<TvSeriesWatchProvidersResultsIEBuy>
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
     * @return array<TvSeriesWatchProvidersResultsIEFlatrate>
     */
    public function getFlatrate(): array
    {
        return $this->flatrate;
    }

    /**
     * @param array<TvSeriesWatchProvidersResultsIEFlatrate> $flatrate
     */
    public function setFlatrate(array $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }

    /**
     * @return array<TvSeriesWatchProvidersResultsIEBuy>
     */
    public function getBuy(): array
    {
        return $this->buy;
    }

    /**
     * @param array<TvSeriesWatchProvidersResultsIEBuy> $buy
     */
    public function setBuy(array $buy): self
    {
        $this->buy = $buy;

        return $this;
    }
}