<?php

namespace app\Services;

use app\Models\User;
use app\Repositories\UserRepository;
use app\Repositories\UserRepositoryImpl;

class UserServiceImpl implements UserService
{
    /**
     * @var UserRepository|UserRepositoryImpl
     */
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepositoryImpl();
    }

    /**
     * @param User $user
     * @return void
     */
    public function save(User $user): void
    {
        $this->userRepository->save($user);
    }

    /**
     * @return int
     */
    public function findNextId(): int
    {
        $id = 0;
        $column = $this->userRepository->findColumns(['id']);
        if (!empty($column)) {
            $id = $column[sizeof($column) - 1]['id'];
        }
        return $id + 1;
    }

    /**
     * @param string $login
     * @return User
     */
    public function findByLogin(string $login): User
    {
        $users = $this->userRepository->findByColumn('login', $login);
        return $users[0];
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function findByColumn(string $column, string $value): array
    {
        return $this->userRepository->findByColumn($column, $value);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $all = $this->findAll();
        for ($i = 0; $i < sizeof($all); $i++) {
            if ($all[$i]->getId() === $id) {
                unset($all[$i]);
                break;
            }
        }
        $this->saveAll($all);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $decode = $this->userRepository->findAll();
        $users = [];
        foreach ($decode as $json) {
            $users[] = User::jsonDeserialize($json);
        }
        return $users;
    }

    /**
     * @param array $data
     * @return void
     */
    public function saveAll(array $data): void
    {
        $this->userRepository->saveAll($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data): void
    {
        $user = $this->findByColumn('id', $id);
        if (!empty($user)) {
            $user = $user[0];
            foreach ($data as $key => $value) {
                $user->{'set' . ucfirst($key)}($value);
            }
            $this->userRepository->update($user);
        }
    }
}