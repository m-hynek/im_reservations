<?php

namespace App\Security;

trait SecuredPresenter
{
    protected function startup()
    {
        parent::startup();

        if (!$this->user->isLoggedIn()) {
            $this->redirect('User:login');
        }
    }
}