<?php

namespace App\Service;

use App\Entity\ApiToken;
use App\Entity\User;
use App\Form\Model\UserRegistrationFormModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
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
        $this->em->persist(new ApiToken($user));
        $this->em->flush();

        return $user;
    }

    /**
     * @param User $userModel
     * @return User
     */
    public function editUser(User $userModel): User
    {
        $user = new User();

        $userModel
            ->setEmail($userModel->getEmail())
            ->setFirstName($userModel->getFirstName())
            ->setPassword($userModel->getPassword())
            ->setRoles($userModel->getRoles())
        ;

        $this->em->persist($userModel);
        $this->em->flush();

        return $userModel;
    }
}