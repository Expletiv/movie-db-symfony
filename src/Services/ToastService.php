<?php

namespace App\Services;

use App\Message\Toast\Toast;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;

readonly class ToastService
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    public function addToast(Toast $toast): void
    {
        $session = $this->requestStack->getSession();
        assert($session instanceof FlashBagAwareSessionInterface);
        $session->getFlashBag()->add('toast', $toast);
    }
}
