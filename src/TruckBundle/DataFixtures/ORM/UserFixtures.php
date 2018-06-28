<?php

declare(strict_types=1);

namespace TruckBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use TruckBundle\Entity\User;

class UserFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $dataProvider = [
            [
                'username' => 'ccwrcuser',
                'password' => 'ccwrcuser',
                'email' => 'ccwrcuser@fake.1mail',
                'roles' => [
                    'ROLE_USER'
                ]
            ],
            [
                'username' => 'ccwrcdealer',
                'password' => 'ccwrcdealer',
                'email' => 'ccwrcdealer@fake.1mail',
                'roles' => [
                    'ROLE_USER',
                    'ROLE_DEALER'
                ]
            ],
            [
                'username' => 'ccwrcoperator',
                'password' => 'ccwrcoperator',
                'email' => 'ccwrcoperator@fake.1mail',
                'roles' => [
                    'ROLE_USER',
                    'ROLE_OPERATOR'
                ]
            ],
            [
                'username' => 'ccwrccontrol',
                'password' => 'ccwrccontrol',
                'email' => 'ccwrccontrol@fake.1mail',
                'roles' => [
                    'ROLE_USER',
                    'ROLE_CONTROL'
                ]
            ],
            [
                'username' => 'ccwrcadmin',
                'password' => 'ccwrcadmin',
                'email' => 'ccwrcadmin@fake.1mail',
                'roles' => [
                    'ROLE_USER',
                    'ROLE_ADMIN'
                ]
            ],
            [
                'username' => 'ccwrcsuperadmin',
                'password' => 'ccwrcsuperadmin',
                'email' => 'ccwrcsuperadmin@fake.1mail',
                'roles' => [
                    'ROLE_USER',
                    'ROLE_SUPER_ADMIN'
                ]
            ],
        ];

        foreach ($dataProvider as $data) {
            $user = new User();
            $user->setUsername($data['username']);
            $user->setPlainPassword($data['password']);
            $user->setEmail($data['email']);
            $user->setRoles($data['roles']);
            $user->setEnabled(true);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
