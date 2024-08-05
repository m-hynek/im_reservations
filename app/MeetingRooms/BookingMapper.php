<?php declare(strict_types=1);

namespace App\MeetingRooms;

use Nextras\Orm\Mapper\Dbal\DbalMapper;

/**
 * @extends DbalMapper<Booking>
 */
class BookingMapper extends DbalMapper
{
    protected $tableName = 'booking';

}