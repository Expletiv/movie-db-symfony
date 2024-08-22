<?php

namespace App\Dto\Tmdb\Responses\Watch;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class WatchProvidersMovieListResults
{
    #[SerializedName('display_priorities')]
    private ?WatchProvidersMovieListResultsDisplayPriorities $displayPriorities = null;
    #[SerializedName('display_priority')]
    private ?int $displayPriority = null;
    #[SerializedName('logo_path')]
    private ?string $logoPath = null;
    #[SerializedName('provider_name')]
    private ?string $providerName = null;
    #[SerializedName('provider_id')]
    private ?int $providerId = null;

    public function getDisplayPriorities(): ?WatchProvidersMovieListResultsDisplayPriorities
    {
        return $this->displayPriorities;
    }

    public function setDisplayPriorities(?WatchProvidersMovieListResultsDisplayPriorities $displayPriorities): self
    {
        $this->displayPriorities = $displayPriorities;

        return $this;
    }

    public function getDisplayPriority(): ?int
    {
        return $this->displayPriority;
    }

    public function setDisplayPriority(?int $displayPriority): self
    {
        $this->displayPriority = $displayPriority;

        return $this;
    }

    public function getLogoPath(): ?string
    {
        return $this->logoPath;
    }

    public function setLogoPath(?string $logoPath): self
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    public function getProviderName(): ?string
    {
        return $this->providerName;
    }

    public function setProviderName(?string $providerName): self
    {
        $this->providerName = $providerName;

        return $this;
    }

    public function getProviderId(): ?int
    {
        return $this->providerId;
    }

    public function setProviderId(?int $providerId): self
    {
        $this->providerId = $providerId;

        return $this;
    }
}