<?php

namespace App\Dto\Tmdb\Responses\Find;

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
class FindByIdMovieResults
{
    #[SerializedName('adult')]
    private ?bool $adult = null;
    #[SerializedName('backdrop_path')]
    private ?string $backdropPath = null;
    #[SerializedName('id')]
    private ?int $id = null;
    #[SerializedName('title')]
    private ?string $title = null;
    #[SerializedName('original_language')]
    private ?string $originalLanguage = null;
    #[SerializedName('original_title')]
    private ?string $originalTitle = null;
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
    #[SerializedName('release_date')]
    private ?string $releaseDate = null;
    #[SerializedName('video')]
    private ?bool $video = null;
    #[SerializedName('vote_average')]
    private ?float $voteAverage = null;
    #[SerializedName('vote_count')]
    private ?int $voteCount = null;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(?string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

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

    public function getReleaseDate(): ?string
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?string $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getVideo(): ?bool
    {
        return $this->video;
    }

    public function setVideo(?bool $video): self
    {
        $this->video = $video;

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
}