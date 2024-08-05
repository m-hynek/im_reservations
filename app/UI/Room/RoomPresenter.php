<?php

declare(strict_types=1);

namespace App\UI\Room;

use App\MeetingRooms\Booking;
use App\MeetingRooms\RoomService;
use App\Security\SecuredPresenter;
use App\Security\SecurityService;
use Nette\Application\UI\Presenter;
use Nextras\Dbal\Utils\DateTimeImmutable;


final class RoomPresenter extends Presenter
{
    use SecuredPresenter;

    public function __construct(
        private RoomService     $roomService,
        private SecurityService $securityService,
    )
    {
    }

    public function renderDefault(int $id): void
    {
        try {
            $room = $this->roomService->get($id);
        } catch (\Throwable) {
            $this->flashMessage('not found');
            $this->redirect('Home:');
        }

        //nezobrazujeme minulost
        $bookings = $room->bookings->toCollection()->findBy(['end>=' => new DateTimeImmutable()]);

        //pripravime data pro kalendar
        $events = array_map(function($booking) {
            /** @var Booking $booking */
            return [
                'id' => $booking->getId(),
                'title' => $booking->getUser()->getId() === $this->getUser()->getId() ? 'Mate rezervovano' : 'Nekdo jiny ma zarezervovano',
                'start' => $booking->getStart()->format(DateTimeImmutable::ATOM),
                'end' => $booking->getEnd()->format(DateTimeImmutable::ATOM),
            ];
        }, $bookings->fetchAll());

        $this->getTemplate()->events = $events;
        $this->getTemplate()->room = $room;
    }

    public function actionBook(): void
    {
        $start = new DateTimeImmutable($this->getHttpRequest()->getPost('start'));
        $end = new DateTimeImmutable($this->getHttpRequest()->getPost('end'));

        //kdyby to prislo naopak
        if ($start > $end) {
            [$start, $end] = [$end, $start];
        }

        $roomId = (int)$this->getHttpRequest()->getPost('room');

        //ulozime pokud je volno
        $this->roomService->book(
            $start,
            $end,
            $this->roomService->get($roomId),
            $this->securityService->getByEmail($this->getUser()->getIdentity()->getData()['email']),
        );

        $this->terminate();
    }

    public function actionUnbook(): void
    {
        //smaze pokud je to uzivateluv booking
        $this->roomService->unbook(
            $this->roomService->getBooking((int)$this->getHttpRequest()->getPost('event_id')),
            $this->securityService->getByEmail($this->getUser()->getIdentity()->getData()['email'])
        );

        $this->terminate();
    }
}
