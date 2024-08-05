<?php

declare(strict_types=1);

namespace App\Security;

use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;

class Bouncer implements Authenticator
{
    public function __construct(
        private UserRepository $userRepository,
        private Passwords      $passwords,
    )
    {
    }

    public function authenticate(string $email, string $password): SimpleIdentity
    {
        try {
            $user = $this->userRepository->getByEmail($email);
        } catch (\Throwable) {
            throw new AuthenticationException('User not found.');
        }

        if (!$this->passwords->verify($password, $user->getPassword())) {
            throw new AuthenticationException('Invalid password.');
        }

        return new SimpleIdentity(
            $user->getId(),
            null,
            ['email' => $user->getEmail()],
        );
    }
}