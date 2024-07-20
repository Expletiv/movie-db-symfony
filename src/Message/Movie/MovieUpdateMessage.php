<?php

namespace App\Message\Movie;

readonly class MovieUpdateMessage
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
