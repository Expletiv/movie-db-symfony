<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvEpisodeGroupDetailsGroupsEpisodes
{
    #[SerializedName('air_date')]
    private ?string $airDate = null;
    #[SerializedName('episode_number')]
    private ?int $episodeNumber = null;
    #[SerializedName('id')]
    private ?int $id = null;
    #[SerializedName('name')]
    private ?string $name = null;
    #[SerializedName('overview')]
    private ?string $overview = null;
    #[SerializedName('production_code')]
    private ?string $productionCode = null;
    #[SerializedName('runtime')]
    private ?string $runtime = null;
    #[SerializedName('season_number')]
    private ?int $seasonNumber = null;
    #[SerializedName('show_id')]
    private ?int $showId = null;
    #[SerializedName('still_path')]
    private ?string $stillPath = null;
    #[SerializedName('vote_average')]
    private ?float $voteAverage = null;
    #[SerializedName('vote_count')]
    private ?int $voteCount = null;
    #[SerializedName('order')]
    private ?int $order = null;

    public static function fromArray(array $data = []): self
    {
        $typeExtractor = new PropertyInfoExtractor(typeExtractors: [new PhpDocExtractor(), new PropertyInfoExtractor()]);
        $serializer = new Serializer([new ObjectNormalizer(
            nameConverter: new CamelCaseToSnakeCaseNameConverter(),  propertyTypeExtractor: $typeExtractor),
            new ArrayDenormalizer()
        ]);
        return $serializer->denormalize($data, self::class);
    }

    public function toArray(): array
    {
        $typeExtractor = new PropertyInfoExtractor(typeExtractors: [new PhpDocExtractor(), new PropertyInfoExtractor()]);
        $serializer = new Serializer([new ObjectNormalizer(
            nameConverter: new CamelCaseToSnakeCaseNameConverter(),
            propertyTypeExtractor: $typeExtractor
        )]);
        return $serializer->normalize($this);
    }

    public function getAirDate(): ?string
    {
        return $this->airDate;
    }

    public function setAirDate(?string $airDate): self
    {
        $this->airDate = $airDate;

        return $this;
    }

    public function getEpisodeNumber(): ?int
    {
        return $this->episodeNumber;
    }

    public function setEpisodeNumber(?int $episodeNumber): self
    {
        $this->episodeNumber = $episodeNumber;

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

    public function getProductionCode(): ?string
    {
        return $this->productionCode;
    }

    public function setProductionCode(?string $productionCode): self
    {
        $this->productionCode = $productionCode;

        return $this;
    }

    public function getRuntime(): ?string
    {
        return $this->runtime;
    }

    public function setRuntime(?string $runtime): self
    {
        $this->runtime = $runtime;

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

    public function getShowId(): ?int
    {
        return $this->showId;
    }

    public function setShowId(?int $showId): self
    {
        $this->showId = $showId;

        return $this;
    }

    public function getStillPath(): ?string
    {
        return $this->stillPath;
    }

    public function setStillPath(?string $stillPath): self
    {
        $this->stillPath = $stillPath;

        return $this;
    }

    public function getVoteAverage(): ?float
    {
        return $this->voteAverage;
    }

    public function setVoteAverage(?float $voteAverage): self
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }

    public function getVoteCount(): ?int
    {
        return $this->voteCount;
    }

    public function setVoteCount(?int $voteCount): self
    {
        $this->voteCount = $voteCount;

        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): self
    {
        $this->order = $order;

        return $this;
    }
}