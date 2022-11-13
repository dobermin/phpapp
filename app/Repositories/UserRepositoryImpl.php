<?php

namespace app\Repositories;

use app\Core\Config;
use app\Models\User;

class UserRepositoryImpl implements UserRepository
{
    /**
     * @var string
     */
    private string $file = Config::FILE_DATABASE;

    /**
     * @param User $user
     * @return void
     */
    public function save(User $user): void
    {
        $all = $this->findAll();
        $serialize = [$user];
        if ($all) {
            $serialize = array_merge($all, $serialize);
        }
        $this->saveAll($serialize);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $file = file_get_contents($this->file);
        $json = json_decode($file, true);
        $users = [];
        if (!empty($json)) {
            foreach ($json as $item) {
                $users[] = User::jsonDeserialize($item);
            }
        }
        return $users;
    }

    /**
     * @param array $data
     * @return void
     */
    public function saveAll(array $data): void
    {
        $this->unsetFile();
        $serialize = [];
        foreach ($data as $item) {
            $serialize[] = $item->jsonSerialize();
        }
        file_put_contents($this->file, json_encode($serialize));
    }

    /**
     * @return void
     */
    private function unsetFile()
    {
        $file = file_get_contents($this->file);
        unset($file);
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function findByColumn(string $column, string $value): array
    {
        $users = [];
        $all = $this->findAll();
        $column = 'get' . ucfirst($column);
        foreach ($all as $item) {
            if ($item->{$column}() == $value) {
                $users[] = $item;
            }
        }
        return $users;
    }

    /**
     * @param array $columns
     * @return array
     */
    public function findColumns(array $columns): array
    {
        $all = $this->findAll();
        $result = [];
        foreach ($all as $item) {
            $res = [];
            foreach ($columns as $column) {
                if ($item->{'get' . ucfirst($column)}() !== null) {
                    $res[$column] = $item->{'get' . ucfirst($column)}();
                }
            }
            if (!empty($res))
                $result[] = $res;
        }

        return $result;
    }

    /**
     * @param User $user
     * @return void
     */
    public function update(User $user): void
    {
        $all = $this->findAll();
        for ($i = 0; $i < sizeof($all); $i++) {
            if ($all[$i]->getId() === $user->getId()) {
                $all[$i] = $user;
            }
        }
        $this->saveAll($all);
    }
}