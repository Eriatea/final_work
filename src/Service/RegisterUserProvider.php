<?php

namespace App\Service;

use App\Entity\User;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

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
     * @var GuardAuthenticatorHandler
     */
    private $guard;
    /**
     * @var LoginFormAuthenticator
     */
    private $authenticator;

    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EntityManagerInterface $em
     * @param GuardAuthenticatorHandler $guard
     * @param LoginFormAuthenticator $authenticator
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em, GuardAuthenticatorHandler $guard, LoginFormAuthenticator $authenticator)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
        $this->guard = $guard;
        $this->authenticator = $authenticator;
    }

    /**
     * @param Request $request
     * @param $form
     * @return Response|null
     */
    public function registerUser(Request $request, $form): ?Response
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();

            $user
                ->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    $form['plainPassword']->getData()))
                ->setRoles(['ROLE_FREE']);

            $this->em->persist($user);
            $this->em->flush();

            return $this->guard->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $this->authenticator,
                'main'
            );
        } else return null;
    }
}