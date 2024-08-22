<?php

namespace App\Twig\Extension;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class UrlExtension extends AbstractExtension
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('movie_details_url', $this->movieDetails(...)),
            new TwigFilter('tmdb_image_url', $this->tmdbImageUrl(...)),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('current_path_with_params', $this->getCurrentPathWithParams(...)),
        ];
    }

    public function movieDetails(int $id): string
    {
        return $this->urlGenerator->generate('app_movie_details', ['tmdbId' => $id]);
    }

    /**
     * @param array<string, int|string> $params
     */
    public function getCurrentPathWithParams(array $params): string
    {
        $request = $this->requestStack->getCurrentRequest();

        return $this->urlGenerator->generate(
            $request->get('_route'),
            array_merge(
                $request->get('_route_params'),
                $request->query->all(),
                $params,
            )
        );
    }

    public function tmdbImageUrl(string $path, string $size = 'original'): string
    {
        return sprintf('https://image.tmdb.org/t/p/%s/%s', $size, $path);
    }
}
