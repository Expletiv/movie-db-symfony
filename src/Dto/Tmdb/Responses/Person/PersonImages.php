<?php

namespace App\Dto\Tmdb\Responses\Person;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class PersonImages
{
    #[SerializedName('id')]
    private ?int $id = null;
    /**
     * @var array<PersonImagesProfiles>
     */
    #[SerializedName('profiles')]
    private array $profiles = [];

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
     * @return array<PersonImagesProfiles>
     */
    public function getProfiles(): array
    {
        return $this->profiles;
    }

    /**
     * @param array<PersonImagesProfiles> $profiles
     */
    public function setProfiles(array $profiles): self
    {
        $this->profiles = $profiles;

        return $this;
    }
}