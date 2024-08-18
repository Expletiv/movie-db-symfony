<?php

namespace App\Services\Interface;

interface TmdbListInterface
{
    /**
     * @param array<string, mixed> $parameters
     * @param array<string, mixed> $headers
     *
     * @return array<string, mixed>
     */
    public function popularMovies(array $parameters = [], array $headers = []): array;

    /**
     * @param array<string, mixed> $parameters
     * @param array<string, mixed> $headers
     *
     * @return array<string, mixed>
     */
    public function discoverMovies(array $parameters = [], array $headers = []): array;

    /**
     * @param array<string, mixed> $parameters
     * @param array<string, mixed> $headers
     *
     * @return array<string, mixed>
     */
    public function topRatedMovies(array $parameters = [], array $headers = []): array;

    /**
     * @param array<string, mixed> $parameters
     * @param array<string, mixed> $headers
     *
     * @return array<string, mixed>
     */
    public function searchMovies(string $query, array $parameters = [], array $headers = []): array;

    /**
     * @param array<string, mixed> $parameters
     * @param array<string, mixed> $headers
     *
     * @return array<string, mixed>
     */
    public function recommendedMovies(int $tmdbId, array $parameters = [], array $headers = []): array;
}
