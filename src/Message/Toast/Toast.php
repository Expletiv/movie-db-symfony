<?php

namespace App\Message\Toast;

use App\Enum\ToastStyle;
use Symfony\Component\Translation\TranslatableMessage;

readonly class Toast
{
    private string|TranslatableMessage $message;
    private string $style;

    public function __construct(string|TranslatableMessage $message, ToastStyle $style = ToastStyle::PRIMARY)
    {
        $this->message = $message;
        $this->style = $style->value;
    }

    public function getMessage(): string|TranslatableMessage
    {
        return $this->message;
    }

    public function getStyle(): string
    {
        return $this->style;
    }
}
