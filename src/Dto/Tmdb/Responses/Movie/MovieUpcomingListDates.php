<?php

namespace App\Dto\Tmdb\Responses\Movie;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class MovieUpcomingListDates
{
    #[SerializedName('maximum')]
    private ?string $maximum = null;
    #[SerializedName('minimum')]
    private ?string $minimum = null;

    public function getMaximum(): ?string
    {
        return $this->maximum;
    }

    public function setMaximum(?string $maximum): self
    {
        $this->maximum = $maximum;

        return $this;
    }

    public function getMinimum(): ?string
    {
        return $this->minimum;
    }

    public function setMinimum(?string $minimum): self
    {
        $this->minimum = $minimum;

        return $this;
    }
}