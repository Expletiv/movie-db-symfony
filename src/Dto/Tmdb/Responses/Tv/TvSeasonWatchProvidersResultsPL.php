<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvSeasonWatchProvidersResultsPL
{
    #[SerializedName('link')]
    private ?string $link = null;
    /**
     * @var array<TvSeasonWatchProvidersResultsPLRent>
     */
    #[SerializedName('rent')]
    private array $rent = [];
    /**
     * @var array<TvSeasonWatchProvidersResultsPLFlatrate>
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
     * @return array<TvSeasonWatchProvidersResultsPLRent>
     */
    public function getRent(): array
    {
        return $this->rent;
    }

    /**
     * @param array<TvSeasonWatchProvidersResultsPLRent> $rent
     */
    public function setRent(array $rent): self
    {
        $this->rent = $rent;

        return $this;
    }

    /**
     * @return array<TvSeasonWatchProvidersResultsPLFlatrate>
     */
    public function getFlatrate(): array
    {
        return $this->flatrate;
    }

    /**
     * @param array<TvSeasonWatchProvidersResultsPLFlatrate> $flatrate
     */
    public function setFlatrate(array $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }
}