<?php

declare(strict_types=1);

namespace App\Security;

use Nette\Security\Passwords;
use Nette\Utils\Validators;
use Nextras\Dbal\Utils\DateTimeImmutable;

class SecurityService
{
    public function __construct(
        private UserRepository $userRepository,
        private Passwords      $passwords
    )
    {
    }

    public function createUser(string $email, string $password): void
    {
        if (!Validators::isEmail($email)) {
            throw new \InvalidArgumentException('not email');
        }

        $user = new User;
        $user
            ->setEmail($email)
            ->setPassword($this->passwords->hash($password))
            ->setCreated(new DateTimeImmutable);

        $this->userRepository->persistAndFlush($user);
    }

    public function getByEmail(string $email) : User
    {
        return $this->userRepository->getByEmail($email);
    }
}