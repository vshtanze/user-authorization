<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use App\Security\AppCustomAuthenticator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const DATA = [
        [
            'username' => 'bruce',
            'password' => 'imbatman',
            'roles'    => [AppCustomAuthenticator::ROLE_USER],
        ],
        [
            'username' => 'tony',
            'password' => 'stark123',
            'roles'    => [AppCustomAuthenticator::ROLE_USER, AppCustomAuthenticator::ROLE_SUPER_ADMIN],
        ],
        [
            'username' => 'joker',
            'password' => 'hahaha1',
            'roles'    => [AppCustomAuthenticator::ROLE_USER, AppCustomAuthenticator::ROLE_ADMIN],
        ],
        [
            'username' => 'peter parker',
            'password' => 'friendlyspider',
            'roles'    => [AppCustomAuthenticator::ROLE_USER],
        ],
    ];

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATA as $userData) {
            $user = $manager->getRepository(User::class)->findOneby(['username' => $userData['username']]);

            if (!$user instanceof User) {
                $user = new User();
                $user->setUsername($userData['username']);
                $manager->persist($user);
            }

            $user->setRoles($userData['roles']);
            $hashedPassword = $this->passwordHasher
                ->hashPassword(
                    $user,
                    $userData['password'],
                );
            $user->setPassword($hashedPassword);
        }

        $manager->flush();
    }
}
