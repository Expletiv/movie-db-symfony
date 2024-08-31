<?php

namespace App\Enum;

use Symfony\Component\Translation\TranslatableMessage;

use function Symfony\Component\Translation\t;

enum PageType: string
{
    case HOME = 'home';

    /**
     * @return array<string, TranslatableMessage>
     */
    public static function getTranslatableChoices(): array
    {
        return [
            self::HOME->value => t('enum.page_type.home'),
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function getBadgeStyles(): array
    {
        return [
            self::HOME->value => 'primary',
        ];
    }
}
