<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterUserProvider
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EntityManagerInterface $em
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
    }

    /**
     * @param string $email
     * @param string $firstName
     * @param string $password
     * @return User
     */
    public function registerUser(string $email, string $firstName, string $password): User
    {
        $user = new User();
        $user
            ->setEmail($email)
            ->setFirstName($firstName)
            ->setPassword($this->passwordEncoder->encodePassword($user, $password))
            ->setRoles(['ROLE_FREE']);

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}