<?php

namespace App\Dto\Tmdb\Responses\Watch;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class WatchProvidersMovieList
{
    /**
     * @var array<WatchProvidersMovieListResults>
     */
    #[SerializedName('results')]
    private array $results = [];

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
     * @return array<WatchProvidersMovieListResults>
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array<WatchProvidersMovieListResults> $results
     */
    public function setResults(array $results): self
    {
        $this->results = $results;

        return $this;
    }
}