<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class EditUserProvider
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
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