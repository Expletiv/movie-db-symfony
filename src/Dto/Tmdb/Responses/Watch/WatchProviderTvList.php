<?php

namespace App\Dto\Tmdb\Responses\Watch;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class WatchProviderTvList
{
    /**
     * @var array<WatchProviderTvListResults>
     */
    #[SerializedName('results')]
    private array $results = [];

    /**
     * @return array<WatchProviderTvListResults>
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array<WatchProviderTvListResults> $results
     */
    public function setResults(array $results): self
    {
        $this->results = $results;

        return $this;
    }
}