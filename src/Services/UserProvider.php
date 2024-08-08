<?php

namespace App\Services;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

readonly class UserProvider
{
    public function __construct(
        private Security $security,
        private AuthorizationCheckerInterface $authorizationChecker,
    ) {
    }

    public function authenticateUser(): User
    {
        $user = $this->security->getUser();
        if (!$this->authorizationChecker->isGranted('IS_AUTHENTICATED') || !$user instanceof User) {
            throw new AccessDeniedException();
        }

        return $user;
    }
}
