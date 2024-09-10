<?php

namespace App\DataFixtures;

use App\Entity\User;
use Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends DataFixture
{
    public const string TEST_USER_REFERENCE = 'test_user';
    public const int TEST_USER_ID = 1;
    public const string TEST_ADMIN_REFERENCE = 'test_admin';
    public const int TEST_ADMIN_ID = 2;

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    protected function provideEntities(): Generator
    {
        $user = new User();
        $user->setId(self::TEST_USER_ID);
        $user->setEmail('test.user@mail.com');
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'password'
        ));
        $user->setVerified(true);
        $this->addReference(self::TEST_USER_REFERENCE, $user);

        yield $user;

        $admin = new User();
        $admin->setId(self::TEST_ADMIN_ID);
        $admin->setEmail('test.admin@mail.com');
        $admin->setPassword($this->passwordHasher->hashPassword(
            $admin,
            'password'
        ));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setVerified(true);
        $this->addReference(self::TEST_ADMIN_REFERENCE, $admin);

        yield $admin;
    }
}
