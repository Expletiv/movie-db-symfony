<?php

namespace App\Dto\Tmdb\Responses\Tv;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class TvSeriesTranslations
{
    #[SerializedName('id')]
    private ?int $id = null;
    /**
     * @var array<TvSeriesTranslationsTranslations>
     */
    #[SerializedName('translations')]
    private array $translations = [];

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
     * @return array<TvSeriesTranslationsTranslations>
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * @param array<TvSeriesTranslationsTranslations> $translations
     */
    public function setTranslations(array $translations): self
    {
        $this->translations = $translations;

        return $this;
    }
}