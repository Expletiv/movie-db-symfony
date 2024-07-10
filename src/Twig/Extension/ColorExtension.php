<?php

namespace App\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ColorExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('rating_to_hsl', $this->ratingToHsl(...)),
        ];
    }

    public function ratingToHsl(float $rating): string
    {
        $hue = $rating * $rating / 8 * 10;

        return sprintf('hsl(%f, 100%%, 50%%)', $hue);
    }
}
