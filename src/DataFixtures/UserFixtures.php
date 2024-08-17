<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const string TEST_USER_REFERENCE = 'test_user';
    public const int TEST_USER_ID = 1;

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setId(1);
        $user->setEmail('test.user@mail.com');
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'password'
        ));
        $user->setVerified(true);

        $this->addReference(self::TEST_USER_REFERENCE, $user);
        $manager->persist($user);
        $manager->flush();
    }
}
