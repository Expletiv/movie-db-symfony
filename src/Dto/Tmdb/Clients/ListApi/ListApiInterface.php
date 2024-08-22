<?php

namespace App\Dto\Tmdb\Clients\ListApi;

use App\Dto\Tmdb\Responses\List\ListDetails;
use App\Dto\Tmdb\Responses\List\ListCheckItemStatus;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
interface ListApiInterface
{
    /**
     * /3/list/{list_id}
     */
    public function listDetails(int $listId, ?int $page = 1, ?string $language = 'en-US'): ListDetails;

    /**
     * /3/list/{list_id}/item_status - Use this method to check if an item has already been added to the list.
     */
    public function listCheckItemStatus(int $listId, ?int $movieId = null, ?string $language = 'en-US'): ListCheckItemStatus;
}