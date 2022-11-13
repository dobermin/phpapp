<?php

namespace app\Classes;

interface Validate
{
    /**
     * @param array $data
     * @param array $rules
     * @return void
     */
    public static function make(array $data = [], array $rules = []): void;

    /**
     * @param string $value
     * @return string
     */
    public static function min(string $value): string;

    /**
     * @param string $service
     * @return string
     */
    public static function unique(string $service): string;

    /**
     * @param string $pattern
     * @return string
     */
    public static function regex(string $pattern): string;

    /**
     * @param string $key
     * @return string
     */
    public static function compare(string $key): string;

    /**
     * @param string $key
     * @return string
     */
    public static function is(string $key): string;

    /**
     * @param string $service
     * @return string
     */
    public static function isset(string $service): string;

    /**
     * @return string
     */
    public static function email(): string;

    /**
     * @param string $bool
     * @return string
     */
    public static function request(string $bool): string;

    /**
     * @return array
     */
    public static function getErrors(): array;

    /**
     * @return bool
     */
    public static function hasErrors(): bool;
}