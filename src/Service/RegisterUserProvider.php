<?php

namespace App\Service;

use App\Entity\User;
use App\Form\Model\UserRegistrationFormModel;
use Doctrine\ORM\EntityManagerInterface;
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
     * @param UserRegistrationFormModel $userModel
     * @return User
     */
    public function registerUser(UserRegistrationFormModel $userModel): User
    {
        $user = new User();

        $user
            ->setEmail($userModel->email)
            ->setFirstName($userModel->firstName)
            ->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $userModel->plainPassword
            ))
            ->setRoles(['ROLE_FREE'])
        ;

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}