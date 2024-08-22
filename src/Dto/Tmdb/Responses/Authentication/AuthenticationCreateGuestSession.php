<?php

namespace App\Dto\Tmdb\Responses\Authentication;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class AuthenticationCreateGuestSession
{
    #[SerializedName('success')]
    private ?bool $success = null;
    #[SerializedName('guest_session_id')]
    private ?string $guestSessionId = null;
    #[SerializedName('expires_at')]
    private ?string $expiresAt = null;

    public function getSuccess(): ?bool
    {
        return $this->success;
    }

    public function setSuccess(?bool $success): self
    {
        $this->success = $success;

        return $this;
    }

    public function getGuestSessionId(): ?string
    {
        return $this->guestSessionId;
    }

    public function setGuestSessionId(?string $guestSessionId): self
    {
        $this->guestSessionId = $guestSessionId;

        return $this;
    }

    public function getExpiresAt(): ?string
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?string $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }
}