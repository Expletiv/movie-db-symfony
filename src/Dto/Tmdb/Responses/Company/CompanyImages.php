<?php

namespace App\Dto\Tmdb\Responses\Company;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class CompanyImages
{
    #[SerializedName('id')]
    private ?int $id = null;
    /**
     * @var array<CompanyImagesLogos>
     */
    #[SerializedName('logos')]
    private array $logos = [];

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
     * @return array<CompanyImagesLogos>
     */
    public function getLogos(): array
    {
        return $this->logos;
    }

    /**
     * @param array<CompanyImagesLogos> $logos
     */
    public function setLogos(array $logos): self
    {
        $this->logos = $logos;

        return $this;
    }
}