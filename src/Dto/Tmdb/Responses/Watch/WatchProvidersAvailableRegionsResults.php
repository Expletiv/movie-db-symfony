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
class WatchProvidersAvailableRegionsResults
{
    #[SerializedName('iso_3166_1')]
    private ?string $iso31661 = null;
    #[SerializedName('english_name')]
    private ?string $englishName = null;
    #[SerializedName('native_name')]
    private ?string $nativeName = null;

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

    public function getIso31661(): ?string
    {
        return $this->iso31661;
    }

    public function setIso31661(?string $iso31661): self
    {
        $this->iso31661 = $iso31661;

        return $this;
    }

    public function getEnglishName(): ?string
    {
        return $this->englishName;
    }

    public function setEnglishName(?string $englishName): self
    {
        $this->englishName = $englishName;

        return $this;
    }

    public function getNativeName(): ?string
    {
        return $this->nativeName;
    }

    public function setNativeName(?string $nativeName): self
    {
        $this->nativeName = $nativeName;

        return $this;
    }
}