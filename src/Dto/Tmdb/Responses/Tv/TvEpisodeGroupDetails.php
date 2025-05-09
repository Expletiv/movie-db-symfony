<?php

namespace App\Dto\Tmdb\Responses\Tv;

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
class TvEpisodeGroupDetails
{
    #[SerializedName('description')]
    private ?string $description = null;
    #[SerializedName('episode_count')]
    private ?int $episodeCount = null;
    #[SerializedName('group_count')]
    private ?int $groupCount = null;
    /**
     * @var array<TvEpisodeGroupDetailsGroups>
     */
    #[SerializedName('groups')]
    private array $groups = [];
    #[SerializedName('id')]
    private ?string $id = null;
    #[SerializedName('name')]
    private ?string $name = null;
    #[SerializedName('network')]
    private ?TvEpisodeGroupDetailsNetwork $network = null;
    #[SerializedName('type')]
    private ?int $type = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEpisodeCount(): ?int
    {
        return $this->episodeCount;
    }

    public function setEpisodeCount(?int $episodeCount): self
    {
        $this->episodeCount = $episodeCount;

        return $this;
    }

    public function getGroupCount(): ?int
    {
        return $this->groupCount;
    }

    public function setGroupCount(?int $groupCount): self
    {
        $this->groupCount = $groupCount;

        return $this;
    }

    /**
     * @return array<TvEpisodeGroupDetailsGroups>
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @param array<TvEpisodeGroupDetailsGroups> $groups
     */
    public function setGroups(array $groups): self
    {
        $this->groups = $groups;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNetwork(): ?TvEpisodeGroupDetailsNetwork
    {
        return $this->network;
    }

    public function setNetwork(?TvEpisodeGroupDetailsNetwork $network): self
    {
        $this->network = $network;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }
}