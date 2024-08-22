<?php

namespace App\Dto\Tmdb\Responses\Account;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class AccountListsResults
{
    #[SerializedName('description')]
    private ?string $description = null;
    #[SerializedName('favorite_count')]
    private ?int $favoriteCount = null;
    #[SerializedName('id')]
    private ?int $id = null;
    #[SerializedName('item_count')]
    private ?int $itemCount = null;
    #[SerializedName('iso_639_1')]
    private ?string $iso6391 = null;
    #[SerializedName('list_type')]
    private ?string $listType = null;
    #[SerializedName('name')]
    private ?string $name = null;
    #[SerializedName('poster_path')]
    private ?string $posterPath = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFavoriteCount(): ?int
    {
        return $this->favoriteCount;
    }

    public function setFavoriteCount(?int $favoriteCount): self
    {
        $this->favoriteCount = $favoriteCount;

        return $this;
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

    public function getItemCount(): ?int
    {
        return $this->itemCount;
    }

    public function setItemCount(?int $itemCount): self
    {
        $this->itemCount = $itemCount;

        return $this;
    }

    public function getIso6391(): ?string
    {
        return $this->iso6391;
    }

    public function setIso6391(?string $iso6391): self
    {
        $this->iso6391 = $iso6391;

        return $this;
    }

    public function getListType(): ?string
    {
        return $this->listType;
    }

    public function setListType(?string $listType): self
    {
        $this->listType = $listType;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPosterPath(): ?string
    {
        return $this->posterPath;
    }

    public function setPosterPath(?string $posterPath): self
    {
        $this->posterPath = $posterPath;

        return $this;
    }
}