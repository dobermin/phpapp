<?php

namespace app\Core;

interface IRoute
{
    /**
     * @param string $uri
     * @param array $action
     * @return void
     */
    public static function get(string $uri, array $action = []): void;

    /**
     * @param string $uri
     * @param array $action
     * @return void
     */
    public static function post(string $uri, array $action = []): void;
}