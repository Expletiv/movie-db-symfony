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
class MovieWatchProvidersResultsBG
{
    #[SerializedName('link')]
    private ?string $link = null;
    /**
     * @var array<MovieWatchProvidersResultsBGRent>
     */
    #[SerializedName('rent')]
    private array $rent = [];
    /**
     * @var array<MovieWatchProvidersResultsBGBuy>
     */
    #[SerializedName('buy')]
    private array $buy = [];
    /**
     * @var array<MovieWatchProvidersResultsBGFlatrate>
     */
    #[SerializedName('flatrate')]
    private array $flatrate = [];

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
     * @return array<MovieWatchProvidersResultsBGRent>
     */
    public function getRent(): array
    {
        return $this->rent;
    }

    /**
     * @param array<MovieWatchProvidersResultsBGRent> $rent
     */
    public function setRent(array $rent): self
    {
        $this->rent = $rent;

        return $this;
    }

    /**
     * @return array<MovieWatchProvidersResultsBGBuy>
     */
    public function getBuy(): array
    {
        return $this->buy;
    }

    /**
     * @param array<MovieWatchProvidersResultsBGBuy> $buy
     */
    public function setBuy(array $buy): self
    {
        $this->buy = $buy;

        return $this;
    }

    /**
     * @return array<MovieWatchProvidersResultsBGFlatrate>
     */
    public function getFlatrate(): array
    {
        return $this->flatrate;
    }

    /**
     * @param array<MovieWatchProvidersResultsBGFlatrate> $flatrate
     */
    public function setFlatrate(array $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }
}