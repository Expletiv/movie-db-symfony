<?php

namespace App\Dto\Tmdb\Responses\Credit;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class CreditDetails
{
    #[SerializedName('credit_type')]
    private ?string $creditType = null;
    #[SerializedName('department')]
    private ?string $department = null;
    #[SerializedName('job')]
    private ?string $job = null;
    #[SerializedName('media')]
    private ?CreditDetailsMedia $media = null;
    #[SerializedName('media_type')]
    private ?string $mediaType = null;
    #[SerializedName('id')]
    private ?string $id = null;
    #[SerializedName('person')]
    private ?CreditDetailsPerson $person = null;

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

    public function getCreditType(): ?string
    {
        return $this->creditType;
    }

    public function setCreditType(?string $creditType): self
    {
        $this->creditType = $creditType;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getMedia(): ?CreditDetailsMedia
    {
        return $this->media;
    }

    public function setMedia(?CreditDetailsMedia $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getMediaType(): ?string
    {
        return $this->mediaType;
    }

    public function setMediaType(?string $mediaType): self
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPerson(): ?CreditDetailsPerson
    {
        return $this->person;
    }

    public function setPerson(?CreditDetailsPerson $person): self
    {
        $this->person = $person;

        return $this;
    }
}