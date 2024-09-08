<?php

namespace App\Dto\Tmdb\Responses\Person;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class PersonExternalIds
{
    #[SerializedName('id')]
    private ?int $id = null;
    #[SerializedName('freebase_mid')]
    private ?string $freebaseMid = null;
    #[SerializedName('freebase_id')]
    private ?string $freebaseId = null;
    #[SerializedName('imdb_id')]
    private ?string $imdbId = null;
    #[SerializedName('tvrage_id')]
    private ?int $tvrageId = null;
    #[SerializedName('wikidata_id')]
    private ?string $wikidataId = null;
    #[SerializedName('facebook_id')]
    private ?string $facebookId = null;
    #[SerializedName('instagram_id')]
    private ?string $instagramId = null;
    #[SerializedName('tiktok_id')]
    private ?string $tiktokId = null;
    #[SerializedName('twitter_id')]
    private ?string $twitterId = null;
    #[SerializedName('youtube_id')]
    private ?string $youtubeId = null;

    public static function fromArray(array $data = []): self
    {
        $typeExtractor = new PropertyInfoExtractor(typeExtractors: [new PhpDocExtractor(), new PropertyInfoExtractor()]);
        $serializer = new Serializer([new ObjectNormalizer(
            nameConverter: new CamelCaseToSnakeCaseNameConverter(),  propertyTypeExtractor: $typeExtractor),
            new ArrayDenormalizer()
        ]);
        return $serializer->denormalize($data, self::class);
    }

    public function toArray(): array
    {
        $typeExtractor = new PropertyInfoExtractor(typeExtractors: [new PhpDocExtractor(), new PropertyInfoExtractor()]);
        $serializer = new Serializer([new ObjectNormalizer(
            nameConverter: new CamelCaseToSnakeCaseNameConverter(),
            propertyTypeExtractor: $typeExtractor
        )]);
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

    public function getImdbId(): ?string
    {
        return $this->imdbId;
    }

    public function setImdbId(?string $imdbId): self
    {
        $this->imdbId = $imdbId;

        return $this;
    }

    public function getTvrageId(): ?int
    {
        return $this->tvrageId;
    }

    public function setTvrageId(?int $tvrageId): self
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

    public function getFacebookId(): ?string
    {
        return $this->facebookId;
    }

    public function setFacebookId(?string $facebookId): self
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    public function getInstagramId(): ?string
    {
        return $this->instagramId;
    }

    public function setInstagramId(?string $instagramId): self
    {
        $this->instagramId = $instagramId;

        return $this;
    }

    public function getTiktokId(): ?string
    {
        return $this->tiktokId;
    }

    public function setTiktokId(?string $tiktokId): self
    {
        $this->tiktokId = $tiktokId;

        return $this;
    }

    public function getTwitterId(): ?string
    {
        return $this->twitterId;
    }

    public function setTwitterId(?string $twitterId): self
    {
        $this->twitterId = $twitterId;

        return $this;
    }

    public function getYoutubeId(): ?string
    {
        return $this->youtubeId;
    }

    public function setYoutubeId(?string $youtubeId): self
    {
        $this->youtubeId = $youtubeId;

        return $this;
    }
}