<?php

namespace App\Dto\Tmdb\Clients\KeywordApi;

use App\Dto\Tmdb\Responses\Keyword\KeywordDetails;
use App\Dto\Tmdb\Responses\Keyword\KeywordMovies;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
interface KeywordApiInterface
{
    /**
     * /3/keyword/{keyword_id}
     */
    public function keywordDetails(int $keywordId): KeywordDetails;

    /**
     * /3/keyword/{keyword_id}/movies
     */
    public function keywordMovies(string $keywordId, ?int $page = 1, ?string $language = 'en-US', ?bool $includeAdult = false): KeywordMovies;
}