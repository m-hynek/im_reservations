<?php

declare(strict_types=1);

namespace App\MeetingRooms;

use Nextras\Orm\Mapper\Dbal\DbalMapper;

/**
 * @extends DbalMapper<Room>
 */
class RoomMapper extends DbalMapper
{
    protected $tableName = 'room';

}