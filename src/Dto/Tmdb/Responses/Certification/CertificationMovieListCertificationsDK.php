<?php

namespace App\Dto\Tmdb\Responses\Certification;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class CertificationMovieListCertificationsDK
{
    #[SerializedName('certification')]
    private ?string $certification = null;
    #[SerializedName('meaning')]
    private ?string $meaning = null;
    #[SerializedName('order')]
    private ?int $order = null;

    public function getCertification(): ?string
    {
        return $this->certification;
    }

    public function setCertification(?string $certification): self
    {
        $this->certification = $certification;

        return $this;
    }

    public function getMeaning(): ?string
    {
        return $this->meaning;
    }

    public function setMeaning(?string $meaning): self
    {
        $this->meaning = $meaning;

        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): self
    {
        $this->order = $order;

        return $this;
    }
}