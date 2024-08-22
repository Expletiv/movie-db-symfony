<?php

namespace App\Dto\Tmdb\Responses\Movie;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class MovieWatchProvidersResultsCO
{
    #[SerializedName('link')]
    private ?string $link = null;
    /**
     * @var array<MovieWatchProvidersResultsCOBuy>
     */
    #[SerializedName('buy')]
    private array $buy = [];
    /**
     * @var array<MovieWatchProvidersResultsCOFlatrate>
     */
    #[SerializedName('flatrate')]
    private array $flatrate = [];
    /**
     * @var array<MovieWatchProvidersResultsCORent>
     */
    #[SerializedName('rent')]
    private array $rent = [];

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
     * @return array<MovieWatchProvidersResultsCOBuy>
     */
    public function getBuy(): array
    {
        return $this->buy;
    }

    /**
     * @param array<MovieWatchProvidersResultsCOBuy> $buy
     */
    public function setBuy(array $buy): self
    {
        $this->buy = $buy;

        return $this;
    }

    /**
     * @return array<MovieWatchProvidersResultsCOFlatrate>
     */
    public function getFlatrate(): array
    {
        return $this->flatrate;
    }

    /**
     * @param array<MovieWatchProvidersResultsCOFlatrate> $flatrate
     */
    public function setFlatrate(array $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }

    /**
     * @return array<MovieWatchProvidersResultsCORent>
     */
    public function getRent(): array
    {
        return $this->rent;
    }

    /**
     * @param array<MovieWatchProvidersResultsCORent> $rent
     */
    public function setRent(array $rent): self
    {
        $this->rent = $rent;

        return $this;
    }
}