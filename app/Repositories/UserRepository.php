<?php

namespace app\Repositories;

use app\Models\User;

interface UserRepository
{
    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function findByColumn(string $column, string $value): array;

    /**
     * @param array $columns
     * @return array
     */
    public function findColumns(array $columns): array;

    /**
     * @param User $user
     * @return void
     */
    public function save(User $user): void;

    /**
     * @param array $data
     * @return void
     */
    public function saveAll(array $data): void;

    /**
     * @param User $user
     * @return void
     */
    public function update(User $user): void;
}