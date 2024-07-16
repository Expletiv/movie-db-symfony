<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

use function Symfony\Component\Translation\t;

readonly class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
    ) {
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException): RedirectResponse
    {
        /** @var Session $session */
        $session = $request->getSession();
        $session->getFlashBag()->add('login_error', t('templates.login_form.access_denied'));

        return new RedirectResponse(
            $this->urlGenerator->generate('app_login', ['_locale' => $request->getLocale()])
        );
    }
}
