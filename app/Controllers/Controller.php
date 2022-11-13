<?php

namespace app\Controllers;

use app\Classes\Helpers;
use app\Classes\Validator;
use app\Models\User;
use app\Services\UserService;
use app\Services\UserServiceImpl;
use app\View\View;

class Controller
{
    /**
     * @var UserService|UserServiceImpl
     */
    private UserService $userService;

    /**
     *
     */
    public function __construct()
    {
        $this->userService = new UserServiceImpl();
    }

    /**
     * @return void
     */
    public function index(): void
    {
        View::render('homepage', []);
    }

    /**
     * @return void
     */
    public function registration(): void
    {
        View::render('signup', []);
    }

    /**
     * @return void
     */
    public function login(): void
    {
        View::render('login', []);
    }

    /**
     * @return void
     */
    public function signup(): void
    {
        $data = Helpers::post();
        Validator::make($data, [
            'login' => ['request' => true, 'min' => 6, 'unique' => UserServiceImpl::class],
            'password' => ['request' => true, 'min' => 6, 'regex' => '([A-z]+|[0-9]+)'],
            'confirm_password' => ['request' => true, 'compare' => 'password'],
            'email' => ['request' => true, 'is' => 'email', 'unique' => UserServiceImpl::class],
            'name' => ['request' => true, 'min' => 2, 'regex' => '[A-zА-я]*']
        ]);
        if (Validator::hasErrors()) {
            $errors = ['errors' => Validator::getErrors()];
            View::json($errors);
        } else {
            $user = new User(
                $this->userService->findNextId(),
                $data['login'],
                Helpers::hash($data['password']),
                $data['email'],
                $data['name']
            );
            $this->userService->save($user);
            View::json([]);
        }
    }

    /**
     * @return void
     */
    public function enter(): void
    {
        $data = Helpers::post();
        $data['password'] = Helpers::hash($data['password']);
        Validator::make($data, [
            'login' => ['request' => true, 'min' => 6, 'isset' => UserServiceImpl::class],
            'password' => ['request' => true, 'min' => 6, 'regex' => '([A-z]+|[0-9]+)', 'isset' => UserServiceImpl::class]
        ]);
        if (Validator::hasErrors()) {
            $errors = ['errors' => Validator::getErrors()];
            View::json($errors);
        } else {
            $user = $this->userService->findByLogin($data['login']);
            Helpers::setCookies(['name' => $user->getName()]);
            Helpers::setSession(['login' => $user->getLogin()]);
            View::json([]);
        }
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $user = $this->userService->findByLogin($_SESSION['login']);
        Helpers::destroySession();
        Helpers::destroyCookies(['name' => $user->getName()]);
        header('Location: /');
    }
}