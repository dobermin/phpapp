<?php

namespace app\Classes;

class Helpers
{
    /**
     * @return mixed
     */
    public static function post()
    {
        $postData = file_get_contents('php://input');
        return json_decode($postData, true);
    }

    /**
     * @param array $data
     * @return array
     */
    public static function convert(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $key = htmlspecialchars($key);
            $result[$key] = htmlspecialchars($value);
        }
        return $result;
    }

    /**
     * @return void
     */
    public static function destroySession(): void
    {
        session_destroy();
    }

    /**
     * @param array $data
     * @return void
     */
    public static function destroyCookies(array $data): void
    {
        self::setCookies($data, -3600);
    }

    /**
     * @param array $data
     * @param int $time
     * @return void
     */
    public static function setCookies(array $data, int $time = 3600): void
    {
        foreach ($data as $key => $value) {
            setcookie("user[$key]", $value, time() + $time);
        }
    }

    /**
     * @param string $value
     * @return string
     */
    public static function hash(string $value): string
    {
        if (!empty($value)) {
            return 'соль' . md5($value);
        }
        return '';
    }

    /**
     * @param array $data
     * @return void
     */
    public static function setSession(array $data): void
    {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

}