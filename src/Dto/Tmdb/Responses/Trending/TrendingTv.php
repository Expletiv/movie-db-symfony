<?php

namespace App\Dto\Tmdb\Responses\Trending;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TrendingTv
{
    #[SerializedName('page')]
    private ?int $page = null;
    /**
     * @var array<TrendingTvResults>
     */
    #[SerializedName('results')]
    private array $results = [];
    #[SerializedName('total_pages')]
    private ?int $totalPages = null;
    #[SerializedName('total_results')]
    private ?int $totalResults = null;

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

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return array<TrendingTvResults>
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array<TrendingTvResults> $results
     */
    public function setResults(array $results): self
    {
        $this->results = $results;

        return $this;
    }

    public function getTotalPages(): ?int
    {
        return $this->totalPages;
    }

    public function setTotalPages(?int $totalPages): self
    {
        $this->totalPages = $totalPages;

        return $this;
    }

    public function getTotalResults(): ?int
    {
        return $this->totalResults;
    }

    public function setTotalResults(?int $totalResults): self
    {
        $this->totalResults = $totalResults;

        return $this;
    }
}