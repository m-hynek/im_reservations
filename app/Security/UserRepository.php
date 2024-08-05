<?php declare(strict_types=1);

namespace App\Security;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<User>
 */
class UserRepository extends Repository
{
    public static function getEntityClassNames(): array
    {
        return [User::class];
    }

    public function getByEmail(string $email): User
    {
        $user = $this->getBy(['email' => $email]);

        if (!$user instanceof User) {
            throw new \Exception('not found');
        }

        return $user;
    }
}