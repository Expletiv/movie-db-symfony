<?php

namespace App\Dto\Tmdb\Responses\Account;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class AccountWatchlistTv
{
    #[SerializedName('page')]
    private ?int $page = null;
    /**
     * @var array<AccountWatchlistTvResults>
     */
    #[SerializedName('results')]
    private array $results = [];
    #[SerializedName('total_pages')]
    private ?int $totalPages = null;
    #[SerializedName('total_results')]
    private ?int $totalResults = null;

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return array<AccountWatchlistTvResults>
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array<AccountWatchlistTvResults> $results
     */
    public function setResults(array $results): self
    {
        $this->results = $results;

        return $this;
    }

    public function getTotalPages(): ?int
    {
        return $this->totalPages;
    }

    public function setTotalPages(?int $totalPages): self
    {
        $this->totalPages = $totalPages;

        return $this;
    }

    public function getTotalResults(): ?int
    {
        return $this->totalResults;
    }

    public function setTotalResults(?int $totalResults): self
    {
        $this->totalResults = $totalResults;

        return $this;
    }
}