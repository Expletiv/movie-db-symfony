<?php

namespace App\Services;

use App\Enum\ToastStyle;
use App\Message\Toast\Toast;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;
use Symfony\Component\Translation\TranslatableMessage;

readonly class ToastService
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    public function addToast(Toast $toast): void
    {
        $session = $this->requestStack->getSession();
        assert($session instanceof FlashBagAwareSessionInterface);
        $toasts = $session->getFlashBag()->get('toast');

        // check if the toast has not been added already
        if (!in_array($toast, $toasts, true)) {
            $session->getFlashBag()->add('toast', $toast);
        }
    }

    public function primary(string|TranslatableMessage $message): void
    {
        $this->addToast(new Toast($message, ToastStyle::PRIMARY));
    }

    public function success(string|TranslatableMessage $message): void
    {
        $this->addToast(new Toast($message, ToastStyle::SUCCESS));
    }

    public function info(string|TranslatableMessage $message): void
    {
        $this->addToast(new Toast($message, ToastStyle::INFO));
    }

    public function warning(string|TranslatableMessage $message): void
    {
        $this->addToast(new Toast($message, ToastStyle::WARNING));
    }

    public function danger(string|TranslatableMessage $message): void
    {
        $this->addToast(new Toast($message, ToastStyle::DANGER));
    }
}
