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

        if ($this->isRedirectedTurboFrameRequest($request, $response)) {
            // redirectResponse is a redirect hidden as a 204 so fetch() doesn't follow it
            $redirectResponse = new Response(null, 204, [
                'Turbo-Location' => $response->headers->get('Location'),
            ]);
            $event->setResponse($redirectResponse);
        }
    }

    private function isRedirectedTurboFrameRequest(Request $request, Response $response): bool
    {
        return null !== $request->headers->get('Turbo-Frame') && $response->isRedirection();
    }
}
