<?php

namespace App\Dto\Tmdb\Responses\Movie;

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
class MovieWatchProvidersResultsFI
{
    #[SerializedName('link')]
    private ?string $link = null;
    /**
     * @var array<MovieWatchProvidersResultsFIFlatrate>
     */
    #[SerializedName('flatrate')]
    private array $flatrate = [];
    /**
     * @var array<MovieWatchProvidersResultsFIBuy>
     */
    #[SerializedName('buy')]
    private array $buy = [];
    /**
     * @var array<MovieWatchProvidersResultsFIRent>
     */
    #[SerializedName('rent')]
    private array $rent = [];

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return array<MovieWatchProvidersResultsFIFlatrate>
     */
    public function getFlatrate(): array
    {
        return $this->flatrate;
    }

    /**
     * @param array<MovieWatchProvidersResultsFIFlatrate> $flatrate
     */
    public function setFlatrate(array $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }

    /**
     * @return array<MovieWatchProvidersResultsFIBuy>
     */
    public function getBuy(): array
    {
        return $this->buy;
    }

    /**
     * @param array<MovieWatchProvidersResultsFIBuy> $buy
     */
    public function setBuy(array $buy): self
    {
        $this->buy = $buy;

        return $this;
    }

    /**
     * @return array<MovieWatchProvidersResultsFIRent>
     */
    public function getRent(): array
    {
        return $this->rent;
    }

    /**
     * @param array<MovieWatchProvidersResultsFIRent> $rent
     */
    public function setRent(array $rent): self
    {
        $this->rent = $rent;

        return $this;
    }
}