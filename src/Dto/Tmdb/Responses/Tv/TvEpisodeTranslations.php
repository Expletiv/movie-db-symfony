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
class TvEpisodeTranslations
{
    #[SerializedName('id')]
    private ?int $id = null;
    /**
     * @var array<TvEpisodeTranslationsTranslations>
     */
    #[SerializedName('translations')]
    private array $translations = [];

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
     * @return array<TvEpisodeTranslationsTranslations>
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * @param array<TvEpisodeTranslationsTranslations> $translations
     */
    public function setTranslations(array $translations): self
    {
        $this->translations = $translations;

        return $this;
    }
}