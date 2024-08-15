<?php

namespace App\Twig\Extension;

use App\Enum\Role\Role;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RoleExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('roleStyle', $this->getRoleStyle(...)),
            new TwigFilter('roleTransKey', $this->getRoleTranslationKey(...)),
        ];
    }

    public function getRoleStyle(string $role): string
    {
        return Role::tryFrom($role)?->getStyle() ?? '';
    }

    public function getRoleTranslationKey(string $role): string
    {
        return Role::tryFrom($role)?->getTranslationKey() ?? '';
    }
}
