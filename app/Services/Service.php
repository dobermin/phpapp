<?php

namespace app\Services;

interface Service
{
    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data): void;

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function findByColumn(string $column, string $value): array;

    /**
     * @param array $data
     * @return void
     */
    public function saveAll(array $data): void;
}