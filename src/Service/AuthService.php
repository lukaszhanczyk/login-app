<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;

class AuthService
{
    private UserPasswordHasherInterface $passwordHasher;
    private UserRepository $userRepository;
    private AuthenticatorManager $authenticatorManager;
    private FormLoginAuthenticator $authenticator;

    public function __construct(
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepository,
    )
    {
        $this->passwordHasher = $passwordHasher;
        $this->userRepository = $userRepository;

    }

    public function login($parameters)
    {
        $user = new User();

        $user->setEmail($parameters['email']);

        $user->setPassword(password_hash($parameters['password'], PASSWORD_BCRYPT));
        $user = $this->userRepository->findByEmail($user);
        if (!empty($user)){
            $user = $user[0];
            if (password_verify($parameters['password'], $user->getPassword())) {
                return true;
            }
        }
        return false;
    }

    public function register($parameters)
    {

        $user = new User();

        $user->setName($parameters['name']);
        $user->setEmail($parameters['email']);
        $user->setPassword(password_hash($parameters['password'], PASSWORD_BCRYPT));

        $this->userRepository->update($user);
    }
}