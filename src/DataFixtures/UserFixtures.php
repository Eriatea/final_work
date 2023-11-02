<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixtures
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->create(User::class, function (User $user) {
            $user
                ->setEmail('admin@symfony.skillbox')
                ->setFirstName('Администратор')
                ->setPassword($this->userPasswordEncoder->encodePassword($user, '123456'))
                ->setRoles(['ROLE_PRO'])
            ;
        });

        $this->createMany(User::class, 10, function (User $user) {
            $user
                ->setEmail($this->faker->email)
                ->setFirstName($this->faker->firstName)
                ->setPassword($this->userPasswordEncoder->encodePassword($user, '123456'))
                ->setRoles(['ROLE_FREE'])
            ;
        });
    }
}