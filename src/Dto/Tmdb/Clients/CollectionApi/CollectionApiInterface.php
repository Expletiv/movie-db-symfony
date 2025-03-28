<?php

namespace App\Dto\Tmdb\Clients\CollectionApi;

use App\Dto\Tmdb\Responses\Collection\CollectionDetails;
use App\Dto\Tmdb\Responses\Collection\CollectionImages;
use App\Dto\Tmdb\Responses\Collection\CollectionTranslations;

/**
 * This class was auto generated by the TMDB DTO Generator.
 * Do not edit this file manually!
 */
interface CollectionApiInterface
{
    /**
     * /3/collection/{collection_id} - Get collection details by ID.
     */
    public function collectionDetails(int $collectionId, ?string $language = 'en-US'): CollectionDetails;

    /**
     * /3/collection/{collection_id}/images - Get the images that belong to a collection.
     * @param ?string $includeImageLanguage specify a comma separated list of ISO-639-1 values to query, for example: `en,null`
     */
    public function collectionImages(int $collectionId, ?string $language = null, ?string $includeImageLanguage = null): CollectionImages;

    /**
     * /3/collection/{collection_id}/translations
     */
    public function collectionTranslations(int $collectionId): CollectionTranslations;
}