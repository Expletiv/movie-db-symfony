<?php

namespace App\Dto\Tmdb\Responses\Collection;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class CollectionImagesPosters
{
    #[SerializedName('aspect_ratio')]
    private ?float $aspectRatio = null;
    #[SerializedName('height')]
    private ?int $height = null;
    #[SerializedName('iso_639_1')]
    private ?string $iso6391 = null;
    #[SerializedName('file_path')]
    private ?string $filePath = null;
    #[SerializedName('vote_average')]
    private ?float $voteAverage = null;
    #[SerializedName('vote_count')]
    private ?int $voteCount = null;
    #[SerializedName('width')]
    private ?int $width = null;

    public function getAspectRatio(): ?float
    {
        return $this->aspectRatio;
    }

    public function setAspectRatio(?float $aspectRatio): self
    {
        $this->aspectRatio = $aspectRatio;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

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

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function getVoteAverage(): ?float
    {
        return $this->voteAverage;
    }

    public function setVoteAverage(?float $voteAverage): self
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }

    public function getVoteCount(): ?int
    {
        return $this->voteCount;
    }

    public function setVoteCount(?int $voteCount): self
    {
        $this->voteCount = $voteCount;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }
}