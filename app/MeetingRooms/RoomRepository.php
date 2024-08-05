<?php

declare(strict_types=1);

namespace App\MeetingRooms;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<Room>
 */
class RoomRepository extends Repository
{
    public static function getEntityClassNames(): array
    {
        return [Room::class];
    }

    public function get(int $id): Room
    {
        $room = $this->getById($id);

        if (!$room instanceof Room) {
            throw new \Exception('not found');
        }

        return $room;
    }

}