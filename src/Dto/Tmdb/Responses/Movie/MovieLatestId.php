<?php

namespace App\Dto\Tmdb\Responses\Movie;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class MovieLatestId
{
    #[SerializedName('adult')]
    private ?bool $adult = null;
    #[SerializedName('backdrop_path')]
    private ?string $backdropPath = null;
    #[SerializedName('belongs_to_collection')]
    private ?MovieLatestIdBelongsToCollection $belongsToCollection = null;
    #[SerializedName('budget')]
    private ?int $budget = null;
    /**
     * @var array
     */
    #[SerializedName('genres')]
    private array $genres = [];
    #[SerializedName('homepage')]
    private ?string $homepage = null;
    #[SerializedName('id')]
    private ?int $id = null;
    #[SerializedName('imdb_id')]
    private ?string $imdbId = null;
    #[SerializedName('original_language')]
    private ?string $originalLanguage = null;
    #[SerializedName('original_title')]
    private ?string $originalTitle = null;
    #[SerializedName('overview')]
    private ?string $overview = null;
    #[SerializedName('popularity')]
    private ?int $popularity = null;
    #[SerializedName('poster_path')]
    private ?string $posterPath = null;
    /**
     * @var array
     */
    #[SerializedName('production_companies')]
    private array $productionCompanies = [];
    /**
     * @var array
     */
    #[SerializedName('production_countries')]
    private array $productionCountries = [];
    #[SerializedName('release_date')]
    private ?string $releaseDate = null;
    #[SerializedName('revenue')]
    private ?int $revenue = null;
    #[SerializedName('runtime')]
    private ?int $runtime = null;
    /**
     * @var array
     */
    #[SerializedName('spoken_languages')]
    private array $spokenLanguages = [];
    #[SerializedName('status')]
    private ?string $status = null;
    #[SerializedName('tagline')]
    private ?string $tagline = null;
    #[SerializedName('title')]
    private ?string $title = null;
    #[SerializedName('video')]
    private ?bool $video = null;
    #[SerializedName('vote_average')]
    private ?int $voteAverage = null;
    #[SerializedName('vote_count')]
    private ?int $voteCount = null;

    public static function fromArray(array $data = []): self
    {
        $serializer = new Serializer([new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter()), new ArrayDenormalizer()]);
        return $serializer->denormalize($data, self::class);
    }

    public function toArray(): array
    {
        $serializer = new Serializer([new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter()), new ArrayDenormalizer()]);
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

    public function getBelongsToCollection(): ?MovieLatestIdBelongsToCollection
    {
        return $this->belongsToCollection;
    }

    public function setBelongsToCollection(?MovieLatestIdBelongsToCollection $belongsToCollection): self
    {
        $this->belongsToCollection = $belongsToCollection;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(?int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * @return array
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * @param array $genres
     */
    public function setGenres(array $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    public function getHomepage(): ?string
    {
        return $this->homepage;
    }

    public function setHomepage(?string $homepage): self
    {
        $this->homepage = $homepage;

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

    public function getImdbId(): ?string
    {
        return $this->imdbId;
    }

    public function setImdbId(?string $imdbId): self
    {
        $this->imdbId = $imdbId;

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

    public function getPopularity(): ?int
    {
        return $this->popularity;
    }

    public function setPopularity(?int $popularity): self
    {
        $this->popularity = $popularity;

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

    /**
     * @return array
     */
    public function getProductionCompanies(): array
    {
        return $this->productionCompanies;
    }

    /**
     * @param array $productionCompanies
     */
    public function setProductionCompanies(array $productionCompanies): self
    {
        $this->productionCompanies = $productionCompanies;

        return $this;
    }

    /**
     * @return array
     */
    public function getProductionCountries(): array
    {
        return $this->productionCountries;
    }

    /**
     * @param array $productionCountries
     */
    public function setProductionCountries(array $productionCountries): self
    {
        $this->productionCountries = $productionCountries;

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

    public function getRevenue(): ?int
    {
        return $this->revenue;
    }

    public function setRevenue(?int $revenue): self
    {
        $this->revenue = $revenue;

        return $this;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function setRuntime(?int $runtime): self
    {
        $this->runtime = $runtime;

        return $this;
    }

    /**
     * @return array
     */
    public function getSpokenLanguages(): array
    {
        return $this->spokenLanguages;
    }

    /**
     * @param array $spokenLanguages
     */
    public function setSpokenLanguages(array $spokenLanguages): self
    {
        $this->spokenLanguages = $spokenLanguages;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTagline(): ?string
    {
        return $this->tagline;
    }

    public function setTagline(?string $tagline): self
    {
        $this->tagline = $tagline;

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

    public function getVideo(): ?bool
    {
        return $this->video;
    }

    public function setVideo(?bool $video): self
    {
        $this->video = $video;

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