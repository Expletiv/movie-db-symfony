<?php

namespace App\Enum\Role;

enum Role: string
{
    case ROLE_USER = 'ROLE_USER';
    case ROLE_ADMIN = 'ROLE_ADMIN';

    public function getStyle(): string
    {
        return match ($this) {
            self::ROLE_USER => 'primary',
            self::ROLE_ADMIN => 'danger',
        };
    }

    public function getTranslationKey(): string
    {
        return sprintf('enum.role.%s', strtolower($this->value));
    }
}
