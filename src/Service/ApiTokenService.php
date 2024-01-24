<?php

namespace App\Service;

use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ApiTokenService
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
     * @param User $user
     * @return ApiToken
     */
    public function editApiToken(User $user): ApiToken
    {
        $token =  new ApiToken($user);

        $this->em->persist(new ApiToken($user));
        $this->em->flush();

        return $token;
    }
}