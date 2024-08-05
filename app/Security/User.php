<?php declare(strict_types=1);

namespace App\Security;

use App\MeetingRooms\Booking;
use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * @property int $id {primary}
 * @property string $email
 * @property string $password
 * @property DateTimeImmutable $created
 * @property OneHasMany|Booking[] $bookings {1:m Booking::$user}
 */
class User extends Entity
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function setCreated(DateTimeImmutable $created): User
    {
        $this->created = $created;
        return $this;
    }

}