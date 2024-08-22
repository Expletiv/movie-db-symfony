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
class TvSeasonExternalIds
{
    #[SerializedName('id')]
    private ?int $id = null;
    #[SerializedName('freebase_mid')]
    private ?string $freebaseMid = null;
    #[SerializedName('freebase_id')]
    private ?string $freebaseId = null;
    #[SerializedName('tvdb_id')]
    private ?int $tvdbId = null;
    #[SerializedName('tvrage_id')]
    private ?string $tvrageId = null;
    #[SerializedName('wikidata_id')]
    private ?string $wikidataId = null;

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

    public function getFreebaseMid(): ?string
    {
        return $this->freebaseMid;
    }

    public function setFreebaseMid(?string $freebaseMid): self
    {
        $this->freebaseMid = $freebaseMid;

        return $this;
    }

    public function getFreebaseId(): ?string
    {
        return $this->freebaseId;
    }

    public function setFreebaseId(?string $freebaseId): self
    {
        $this->freebaseId = $freebaseId;

        return $this;
    }

    public function getTvdbId(): ?int
    {
        return $this->tvdbId;
    }

    public function setTvdbId(?int $tvdbId): self
    {
        $this->tvdbId = $tvdbId;

        return $this;
    }

    public function getTvrageId(): ?string
    {
        return $this->tvrageId;
    }

    public function setTvrageId(?string $tvrageId): self
    {
        $this->tvrageId = $tvrageId;

        return $this;
    }

    public function getWikidataId(): ?string
    {
        return $this->wikidataId;
    }

    public function setWikidataId(?string $wikidataId): self
    {
        $this->wikidataId = $wikidataId;

        return $this;
    }
}