<?php

declare(strict_types=1);

namespace App\UI\User;

use App\Security\SecurityService;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;

class UserPresenter extends Presenter
{
    public function __construct(
        private SecurityService $securityService,
    )
    {
        parent::__construct();
    }

    public function actionLogout() : void
    {
        $this->getUser()->logout();
        $this->redirect('User:login');
    }

    //zde jsou s trochou fantazie komponenty formularu
    protected function createComponentLoginForm(): Form
    {
        $form = new Form;
        $form->addEmail('email', 'Email:')
            ->setRequired();
        $form->addPassword('password', 'Heslo:')
            ->setRequired();

        $form->addSubmit('login', 'Prihlasit')
            ->onClick[] = [$this, 'login'];

        $form->addSubmit('register', 'Registrovat')
            ->onClick[] = [$this, 'register'];

        return $form;
    }

    public function login(Form $form, array $data): void
    {
        try {
            $this->getUser()->login($data['email'], $data['password']);
        } catch (\Throwable) {
            $this->flashMessage('spatne email nebo heslo');
            $this->redirect('this');
        }

        $this->flashMessage('Login OK');
        $this->redirect('Home:');
    }

    public function register(Form $form, array $data): void
    {
        try {
            $this->securityService->createUser($data['email'], $data['password']);
        } catch (\InvalidArgumentException) {
            $this->flashMessage('chyba pri tvorbe uzivatele - email neni email');
            $this->redirect('this');
        } catch (\Throwable $e) {
            $this->flashMessage($e->getMessage());
            $this->redirect('this');
        }

        $this->login($form, $data);

        $this->flashMessage('Registrace OK');
        $this->redirect('Home:');
    }
}