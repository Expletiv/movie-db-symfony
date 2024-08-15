<?php

namespace App\Listener\Security;

use App\Services\ToastService;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

use function Symfony\Component\Translation\t;

#[AsEventListener]
readonly class LoginSuccessListener
{
    public function __construct(
        private ToastService $toastService,
    ) {
    }

    public function __invoke(LoginSuccessEvent $event): void
    {
        $this->toastService->success(t('templates.login_form.success_flash'));
    }
}
