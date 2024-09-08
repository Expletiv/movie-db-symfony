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
class TvSeriesCredits
{
    /**
     * @var array<TvSeriesCreditsCast>
     */
    #[SerializedName('cast')]
    private array $cast = [];
    /**
     * @var array<TvSeriesCreditsCrew>
     */
    #[SerializedName('crew')]
    private array $crew = [];
    #[SerializedName('id')]
    private ?int $id = null;

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

    /**
     * @return array<TvSeriesCreditsCast>
     */
    public function getCast(): array
    {
        return $this->cast;
    }

    /**
     * @param array<TvSeriesCreditsCast> $cast
     */
    public function setCast(array $cast): self
    {
        $this->cast = $cast;

        return $this;
    }

    /**
     * @return array<TvSeriesCreditsCrew>
     */
    public function getCrew(): array
    {
        return $this->crew;
    }

    /**
     * @param array<TvSeriesCreditsCrew> $crew
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