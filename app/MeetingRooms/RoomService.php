<?php

declare(strict_types=1);

namespace App\MeetingRooms;

use App\Security\User;
use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Collection\ICollection;

class RoomService
{
    public function __construct(
        private readonly RoomRepository    $roomRepository,
        private readonly BookingRepository $bookingRepository
    )
    {
    }

    public function getAll(): ICollection
    {
        return $this->roomRepository->findAll();
    }

    public function get(int $id): Room
    {
        return $this->roomRepository->get($id);
    }

    private function checkAvailability(
        DateTimeImmutable $start,
        DateTimeImmutable $end,
        Room              $room
    )
    {
        if ($start < (new DateTimeImmutable())) {
            return false;
        }

        $bookings = $room->bookings->toCollection()->findBy([
            'start<=' => $end,
            'end>=' => $start
        ]);

        return !$bookings->count();
    }

    public function getBooking(int $id): Booking
    {
        return $this->bookingRepository->get($id);
    }

    public function book(
        DateTimeImmutable $start,
        DateTimeImmutable $end,
        Room              $room,
        User              $user
    ): void
    {
        if (!$this->checkAvailability($start, $end, $room)) {
            return;
        }

        $booking = new Booking();
        $booking
            ->setRoom($room)
            ->setUser($user)
            ->setStart($start)
            ->setEnd($end);

        $this->bookingRepository->persistAndFlush($booking);
    }

    public function unbook(Booking $booking, User $user)
    {
        //zde vyjimky pro adminy atd
        if ($booking->getUser()->getId() === $user->getId()) {
            $this->bookingRepository->removeAndFlush($booking);
        }
    }
}