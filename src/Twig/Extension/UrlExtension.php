<?php

namespace App\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class UrlExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('movie_details_url', $this->movieDetails(...)),
        ];
    }

    public function movieDetails(int $id): string
    {
        return 'movie/'.$id.'/details';
    }
}
