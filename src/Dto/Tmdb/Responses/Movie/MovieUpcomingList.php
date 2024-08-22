<?php

namespace App\Dto\Tmdb\Responses\Movie;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
class MovieUpcomingList
{
    #[SerializedName('dates')]
    private ?MovieUpcomingListDates $dates = null;
    #[SerializedName('page')]
    private ?int $page = null;
    /**
     * @var array<MovieUpcomingListResults>
     */
    #[SerializedName('results')]
    private array $results = [];
    #[SerializedName('total_pages')]
    private ?int $totalPages = null;
    #[SerializedName('total_results')]
    private ?int $totalResults = null;

    public function getDates(): ?MovieUpcomingListDates
    {
        return $this->dates;
    }

    public function setDates(?MovieUpcomingListDates $dates): self
    {
        $this->dates = $dates;

        return $this;
    }

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
     * @return array<MovieUpcomingListResults>
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array<MovieUpcomingListResults> $results
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