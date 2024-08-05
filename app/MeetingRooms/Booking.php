<?php

declare(strict_types=1);

namespace App\MeetingRooms;

use App\Security\User;
use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;

/**
 * @property int $id {primary}
 * @property Room $room {m:1 Room::$bookings}
 * @property User $user {m:1 User::$bookings}
 * @property DateTimeImmutable $start
 * @property DateTimeImmutable $end
 */
class Booking extends Entity
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getRoom(): Room
    {
        return $this->room;
    }

    public function setRoom(Room $room): Booking
    {
        $this->room = $room;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): Booking
    {
        $this->user = $user;
        return $this;
    }

    public function getStart(): DateTimeImmutable
    {
        return $this->start;
    }

    public function setStart(DateTimeImmutable $start): Booking
    {
        $this->start = $start;
        return $this;
    }

    public function getEnd(): DateTimeImmutable
    {
        return $this->end;
    }

    public function setEnd(DateTimeImmutable $end): Booking
    {
        $this->end = $end;
        return $this;
    }

}