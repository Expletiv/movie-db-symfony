<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvSeasonChangesByIdChanges
{
    #[SerializedName('key')]
    private ?string $key = null;
    /**
     * @var array<TvSeasonChangesByIdChangesItems>
     */
    #[SerializedName('items')]
    private array $items = [];

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(?string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return array<TvSeasonChangesByIdChangesItems>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array<TvSeasonChangesByIdChangesItems> $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}