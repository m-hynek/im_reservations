<?php

declare(strict_types=1);

namespace App\MeetingRooms;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * @property int $id {primary}
 * @property string $name
 * @property OneHasMany|Booking[] $bookings {1:m Booking::$room}
 */
class Room extends Entity
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Room
    {
        $this->name = $name;
        return $this;
    }

}