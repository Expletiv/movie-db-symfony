<?php

namespace App\Dto\Tmdb\Responses\Credit;

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
class CreditDetailsMedia
{
    #[SerializedName('adult')]
    private ?bool $adult = null;
    #[SerializedName('backdrop_path')]
    private ?string $backdropPath = null;
    #[SerializedName('id')]
    private ?int $id = null;
    #[SerializedName('name')]
    private ?string $name = null;
    #[SerializedName('original_language')]
    private ?string $originalLanguage = null;
    #[SerializedName('original_name')]
    private ?string $originalName = null;
    #[SerializedName('overview')]
    private ?string $overview = null;
    #[SerializedName('poster_path')]
    private ?string $posterPath = null;
    #[SerializedName('media_type')]
    private ?string $mediaType = null;
    /**
     * @var array<integer>
     */
    #[SerializedName('genre_ids')]
    private array $genreIds = [];
    #[SerializedName('popularity')]
    private ?float $popularity = null;
    #[SerializedName('first_air_date')]
    private ?string $firstAirDate = null;
    #[SerializedName('vote_average')]
    private ?float $voteAverage = null;
    #[SerializedName('vote_count')]
    private ?int $voteCount = null;
    /**
     * @var array<string>
     */
    #[SerializedName('origin_country')]
    private array $originCountry = [];
    #[SerializedName('character')]
    private ?string $character = null;
    /**
     * @var array
     */
    #[SerializedName('episodes')]
    private array $episodes = [];
    /**
     * @var array<CreditDetailsMediaSeasons>
     */
    #[SerializedName('seasons')]
    private array $seasons = [];

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

    public function getAdult(): ?bool
    {
        return $this->adult;
    }

    public function setAdult(?bool $adult): self
    {
        $this->adult = $adult;

        return $this;
    }

    public function getBackdropPath(): ?string
    {
        return $this->backdropPath;
    }

    public function setBackdropPath(?string $backdropPath): self
    {
        $this->backdropPath = $backdropPath;

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

    public function getOriginalLanguage(): ?string
    {
        return $this->originalLanguage;
    }

    public function setOriginalLanguage(?string $originalLanguage): self
    {
        $this->originalLanguage = $originalLanguage;

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): self
    {
        $this->originalName = $originalName;

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

    public function getMediaType(): ?string
    {
        return $this->mediaType;
    }

    public function setMediaType(?string $mediaType): self
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * @return array<integer>
     */
    public function getGenreIds(): array
    {
        return $this->genreIds;
    }

    /**
     * @param array<integer> $genreIds
     */
    public function setGenreIds(array $genreIds): self
    {
        $this->genreIds = $genreIds;

        return $this;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    public function setPopularity(?float $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getFirstAirDate(): ?string
    {
        return $this->firstAirDate;
    }

    public function setFirstAirDate(?string $firstAirDate): self
    {
        $this->firstAirDate = $firstAirDate;

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

    /**
     * @return array<string>
     */
    public function getOriginCountry(): array
    {
        return $this->originCountry;
    }

    /**
     * @param array<string> $originCountry
     */
    public function setOriginCountry(array $originCountry): self
    {
        $this->originCountry = $originCountry;

        return $this;
    }

    public function getCharacter(): ?string
    {
        return $this->character;
    }

    public function setCharacter(?string $character): self
    {
        $this->character = $character;

        return $this;
    }

    /**
     * @return array
     */
    public function getEpisodes(): array
    {
        return $this->episodes;
    }

    /**
     * @param array $episodes
     */
    public function setEpisodes(array $episodes): self
    {
        $this->episodes = $episodes;

        return $this;
    }

    /**
     * @return array<CreditDetailsMediaSeasons>
     */
    public function getSeasons(): array
    {
        return $this->seasons;
    }

    /**
     * @param array<CreditDetailsMediaSeasons> $seasons
     */
    public function setSeasons(array $seasons): self
    {
        $this->seasons = $seasons;

        return $this;
    }
}