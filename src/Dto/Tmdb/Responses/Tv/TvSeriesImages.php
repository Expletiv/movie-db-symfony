<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvSeriesImages
{
    /**
     * @var array<TvSeriesImagesBackdrops>
     */
    #[SerializedName('backdrops')]
    private array $backdrops = [];
    #[SerializedName('id')]
    private ?int $id = null;
    /**
     * @var array<TvSeriesImagesLogos>
     */
    #[SerializedName('logos')]
    private array $logos = [];
    /**
     * @var array<TvSeriesImagesPosters>
     */
    #[SerializedName('posters')]
    private array $posters = [];

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

    /**
     * @return array<TvSeriesImagesBackdrops>
     */
    public function getBackdrops(): array
    {
        return $this->backdrops;
    }

    /**
     * @param array<TvSeriesImagesBackdrops> $backdrops
     */
    public function setBackdrops(array $backdrops): self
    {
        $this->backdrops = $backdrops;

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

    /**
     * @return array<TvSeriesImagesLogos>
     */
    public function getLogos(): array
    {
        return $this->logos;
    }

    /**
     * @param array<TvSeriesImagesLogos> $logos
     */
    public function setLogos(array $logos): self
    {
        $this->logos = $logos;

        return $this;
    }

    /**
     * @return array<TvSeriesImagesPosters>
     */
    public function getPosters(): array
    {
        return $this->posters;
    }

    /**
     * @param array<TvSeriesImagesPosters> $posters
     */
    public function setPosters(array $posters): self
    {
        $this->posters = $posters;

        return $this;
    }
}