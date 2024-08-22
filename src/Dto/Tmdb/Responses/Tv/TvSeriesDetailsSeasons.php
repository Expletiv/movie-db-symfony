<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvSeriesDetailsSeasons
{
    #[SerializedName('air_date')]
    private ?string $airDate = null;
    #[SerializedName('episode_count')]
    private ?int $episodeCount = null;
    #[SerializedName('id')]
    private ?int $id = null;
    #[SerializedName('name')]
    private ?string $name = null;
    #[SerializedName('overview')]
    private ?string $overview = null;
    #[SerializedName('poster_path')]
    private ?string $posterPath = null;
    #[SerializedName('season_number')]
    private ?int $seasonNumber = null;
    #[SerializedName('vote_average')]
    private ?int $voteAverage = null;

    public function getAirDate(): ?string
    {
        return $this->airDate;
    }

    public function setAirDate(?string $airDate): self
    {
        $this->airDate = $airDate;

        return $this;
    }

    public function getEpisodeCount(): ?int
    {
        return $this->episodeCount;
    }

    public function setEpisodeCount(?int $episodeCount): self
    {
        $this->episodeCount = $episodeCount;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(?string $overview): self
    {
        $this->overview = $overview;

        return $this;
    }

    public function getPosterPath(): ?string
    {
        return $this->posterPath;
    }

    public function setPosterPath(?string $posterPath): self
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    public function getSeasonNumber(): ?int
    {
        return $this->seasonNumber;
    }

    public function setSeasonNumber(?int $seasonNumber): self
    {
        $this->seasonNumber = $seasonNumber;

        return $this;
    }

    public function getVoteAverage(): ?int
    {
        return $this->voteAverage;
    }

    public function setVoteAverage(?int $voteAverage): self
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }
}