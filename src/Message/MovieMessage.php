<?php

namespace App\Message;

readonly class MovieMessage
{
    public function __construct(
        private int $id,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
