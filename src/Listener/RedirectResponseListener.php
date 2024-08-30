<?php

namespace App\Listener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

#[AsEventListener]
class RedirectResponseListener
{
    public function __invoke(ResponseEvent $event): void
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        if ($this->isRedirectedTurboFrameRequest($request, $response) && $this->isNotAdminRequest($request)) {
            // do not use RedirectResponse but a custom header so fetch() doesn't follow it
            $redirectResponse = new Response(null, Response::HTTP_FOUND, [
                'Turbo-Location' => $response->headers->get('Location'),
            ]);
            $event->setResponse($redirectResponse);
        }
    }

    private function isRedirectedTurboFrameRequest(Request $request, Response $response): bool
    {
        return null !== $request->headers->get('Turbo-Frame') && $response->isRedirection();
    }

    private function isNotAdminRequest(Request $request): bool
    {
        return !str_starts_with($request->getPathInfo(), '/admin');
    }
}
