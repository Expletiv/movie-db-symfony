<?php

namespace App\Listener\Security;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;

#[AsEventListener]
readonly class LoginFailureListener
{
    public function __construct(
        private HttpKernelInterface $httpKernel,
    ) {
    }

    public function __invoke(LoginFailureEvent $event): void
    {
        $request = $event->getRequest();
        // forward (not redirect!) to the login page if the user is trying to log in
        // through the login frame and there was a login failure
        if ('login_form' === $request->headers->get('Turbo-Frame')) {
            $subResponse = $this->httpKernel->handle($request->duplicate(), HttpKernelInterface::SUB_REQUEST);
            $event->setResponse($subResponse);
        }
    }
}
