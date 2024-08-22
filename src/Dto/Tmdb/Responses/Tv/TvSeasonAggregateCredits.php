<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvSeasonAggregateCredits
{
    /**
     * @var array<TvSeasonAggregateCreditsCast>
     */
    #[SerializedName('cast')]
    private array $cast = [];
    /**
     * @var array<TvSeasonAggregateCreditsCrew>
     */
    #[SerializedName('crew')]
    private array $crew = [];
    #[SerializedName('id')]
    private ?int $id = null;

    /**
     * @return array<TvSeasonAggregateCreditsCast>
     */
    public function getCast(): array
    {
        return $this->cast;
    }

    /**
     * @param array<TvSeasonAggregateCreditsCast> $cast
     */
    public function setCast(array $cast): self
    {
        $this->cast = $cast;

        return $this;
    }

    /**
     * @return array<TvSeasonAggregateCreditsCrew>
     */
    public function getCrew(): array
    {
        return $this->crew;
    }

    /**
     * @param array<TvSeasonAggregateCreditsCrew> $crew
     */
    public function setCrew(array $crew): self
    {
        $this->crew = $crew;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
}