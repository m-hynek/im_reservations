<?php

declare(strict_types=1);

namespace App\MeetingRooms;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<Booking>
 */
class BookingRepository extends Repository
{
    public static function getEntityClassNames(): array
    {
        return [Booking::class];
    }

    public function get(int $id): Booking
    {
        $booking = $this->getById($id);

        if (!$booking instanceof Booking) {
            throw new \Exception('not found');
        }

        return $booking;
    }
}