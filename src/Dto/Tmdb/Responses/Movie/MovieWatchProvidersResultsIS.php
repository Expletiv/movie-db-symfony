<?php

namespace App\Dto\Tmdb\Responses\Movie;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class MovieWatchProvidersResultsIS
{
    #[SerializedName('link')]
    private ?string $link = null;
    /**
     * @var array<MovieWatchProvidersResultsISBuy>
     */
    #[SerializedName('buy')]
    private array $buy = [];
    /**
     * @var array<MovieWatchProvidersResultsISFlatrate>
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
     * @return array<MovieWatchProvidersResultsISBuy>
     */
    public function getBuy(): array
    {
        return $this->buy;
    }

    /**
     * @param array<MovieWatchProvidersResultsISBuy> $buy
     */
    public function setBuy(array $buy): self
    {
        $this->buy = $buy;

        return $this;
    }

    /**
     * @return array<MovieWatchProvidersResultsISFlatrate>
     */
    public function getFlatrate(): array
    {
        return $this->flatrate;
    }

    /**
     * @param array<MovieWatchProvidersResultsISFlatrate> $flatrate
     */
    public function setFlatrate(array $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }
}