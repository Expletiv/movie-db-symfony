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
class TvEpisodeChangesById
{
    /**
     * @var array<TvEpisodeChangesByIdChanges>
     */
    #[SerializedName('changes')]
    private array $changes = [];

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
     * @return array<TvEpisodeChangesByIdChanges>
     */
    public function getChanges(): array
    {
        return $this->changes;
    }

    /**
     * @param array<TvEpisodeChangesByIdChanges> $changes
     */
    public function setChanges(array $changes): self
    {
        $this->changes = $changes;

        return $this;
    }
}