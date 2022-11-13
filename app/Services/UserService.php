<?php

namespace app\Services;

use app\Models\User;

interface UserService extends Service
{
    /**
     * @return int
     */
    public function findNextId(): int;

    /**
     * @param string $login
     * @return User
     */
    public function findByLogin(string $login): User;

    /**
     * @param User $user
     * @return void
     */
    public function save(User $user): void;
}