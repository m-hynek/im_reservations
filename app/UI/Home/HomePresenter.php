<?php

declare(strict_types=1);

namespace App\UI\Home;

use App\MeetingRooms\RoomService;
use App\Security\SecuredPresenter;
use Nette\Application\UI\Presenter;

final class HomePresenter extends Presenter
{
    use SecuredPresenter;

    public function __construct(
        private RoomService $roomService
    )
    {
        parent::__construct();
    }

    public function renderDefault()
    {
        $this->getTemplate()->rooms = $this->roomService->getAll();
    }
}
