<?php

namespace App\Dto\Tmdb\Responses\Movie;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class MovieReleaseDatesResults
{
    #[SerializedName('iso_3166_1')]
    private ?string $iso31661 = null;
    /**
     * @var array<MovieReleaseDatesResultsReleaseDates>
     */
    #[SerializedName('release_dates')]
    private array $releaseDates = [];

    public function getIso31661(): ?string
    {
        return $this->iso31661;
    }

    public function setIso31661(?string $iso31661): self
    {
        $this->iso31661 = $iso31661;

        return $this;
    }

    /**
     * @return array<MovieReleaseDatesResultsReleaseDates>
     */
    public function getReleaseDates(): array
    {
        return $this->releaseDates;
    }

    /**
     * @param array<MovieReleaseDatesResultsReleaseDates> $releaseDates
     */
    public function setReleaseDates(array $releaseDates): self
    {
        $this->releaseDates = $releaseDates;

        return $this;
    }
}