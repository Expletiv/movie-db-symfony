<?php

namespace App\Twig\Extension\OpenApi;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TypeMapperExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('mapType', $this->mapType(...)),
            new TwigFilter('camelCase', $this->camelCase(...)),
            new TwigFilter('pascalCase', $this->pascalCase(...)),
        ];
    }

    public function mapType(string $type): string
    {
        $type = match ($type) {
            'integer' => 'int',
            'number' => 'float',
            'string' => 'string',
            'boolean' => 'bool',
            default => $type,
        };
        if (str_starts_with($type, 'array')) {
            $type = 'array';
        }

        return $type;
    }

    public function camelCase(string $string): string
    {
        // Remove . from parameter names and capitalize next letter (needed for DiscoverApiClient)
        $string = implode('', array_map(ucfirst(...), explode('.', $string)));

        // Replace - with _ (needed for CA-QC in CertificationMovieListCertifications)
        $string = str_replace('-', '_', $string);

        // Do not change if it is in CAPS and has more than one character
        if (strtoupper($string) === $string && strlen($string) > 1) {
            return $string;
        }
        // In TvSeasonDetails there is a $id and a $_id property, so we need this
        if (str_starts_with($string, '_')) {
            return $string;
        }

        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }

    public function pascalCase(string $string): string
    {
        return ucfirst($this->camelCase($string));
    }
}
