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
class MovieWatchProvidersResultsAT
{
    #[SerializedName('link')]
    private ?string $link = null;
    /**
     * @var array<MovieWatchProvidersResultsATFlatrate>
     */
    #[SerializedName('flatrate')]
    private array $flatrate = [];
    /**
     * @var array<MovieWatchProvidersResultsATBuy>
     */
    #[SerializedName('buy')]
    private array $buy = [];
    /**
     * @var array<MovieWatchProvidersResultsATRent>
     */
    #[SerializedName('rent')]
    private array $rent = [];

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
     * @return array<MovieWatchProvidersResultsATFlatrate>
     */
    public function getFlatrate(): array
    {
        return $this->flatrate;
    }

    /**
     * @param array<MovieWatchProvidersResultsATFlatrate> $flatrate
     */
    public function setFlatrate(array $flatrate): self
    {
        $this->flatrate = $flatrate;

        return $this;
    }

    /**
     * @return array<MovieWatchProvidersResultsATBuy>
     */
    public function getBuy(): array
    {
        return $this->buy;
    }

    /**
     * @param array<MovieWatchProvidersResultsATBuy> $buy
     */
    public function setBuy(array $buy): self
    {
        $this->buy = $buy;

        return $this;
    }

    /**
     * @return array<MovieWatchProvidersResultsATRent>
     */
    public function getRent(): array
    {
        return $this->rent;
    }

    /**
     * @param array<MovieWatchProvidersResultsATRent> $rent
     */
    public function setRent(array $rent): self
    {
        $this->rent = $rent;

        return $this;
    }
}