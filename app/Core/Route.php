<?php

namespace app\Core;

class Route implements IRoute
{
    /**
     * @var array
     */
    private static array $requests;

    /**
     * @param string $uri
     * @param array $action
     * @return void
     */
    public static function get(string $uri, array $action = []): void
    {
        self::method('get', $uri, $action);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $action
     * @return void
     */
    private static function method(string $method, string $uri, array $action = []): void
    {
        self::$requests[$method][$uri] = $action;
    }

    /**
     * @param string $uri
     * @param array $action
     * @return void
     */
    public static function post(string $uri, array $action = []): void
    {
        self::method('post', $uri, $action);
    }

    /**
     * @return void
     */
    public static function start(): void
    {
        $method = self::getMethod();
        if (!empty($method)) {
            $requests = self::getRequests();
            $action = $requests[$method];

            $requestUri = self::getRequestUri();
            if (!empty($requestUri)) {
                if (isset($action[$requestUri])) {
                    list($class, $action) = $action[$requestUri];
                    self::run($class, $action);
                } else
                    header('Location: /');
            }
        }
    }

    /**
     * @return string
     */
    private static function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return array
     */
    private static function getRequests(): array
    {
        return self::$requests;
    }

    /**
     * @return string
     */
    private static function getRequestUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @param string $class
     * @param string $action
     * @return void
     */
    private static function run(string $class, string $action): void
    {
        if (class_exists($class)) {
            if (method_exists($class, $action)) {
                (new $class)->{$action}();
            }
        }
    }
}