<?php

namespace app\Classes;

class Validator implements Validate
{
    /**
     * @var array
     */
    private static array $errors = [];
    /**
     * @var array
     */
    private static array $data = [];
    /**
     * @var string
     */
    private static string $key;
    /**
     * @var string
     */
    private static string $value;

    /**
     * @param array $data
     * @param array $rules
     * @return void
     */
    public static function make(array $data = [], array $rules = []): void
    {
        if (!empty($data)) {
            self::$data = Helpers::convert($data);
            foreach (self::$data as $key => $value) {
                self::$key = $key;
                self::$value = $value;
                $error = self::validate($rules[$key]);
                if (!empty($error)) self::$errors[$key] = $error;
            }
        }
    }

    /**
     * @param array $rule
     * @return array
     */
    private static function validate(array $rule): array
    {
        $errors = [];

        if (sizeof($rule) > 0) {
            foreach ($rule as $key => $value) {
                if (method_exists(self::class, $key)) {
                    $error = self::{$key}($value);
                    if (!empty($error))
                        $errors[] = $error;
                }
            }
        }

        return $errors;
    }

    /**
     * @return bool
     */
    public static function hasErrors(): bool
    {
        return sizeof(self::$errors) > 0;
    }

    /**
     * @return array
     */
    public static function getErrors(): array
    {
        return self::$errors;
    }

    /**
     * @param string $value
     * @return string
     */
    public static function min(string $value): string
    {
        $errors = '';
        if (strlen(self::$value) < $value) {
            $errors = sprintf(Message::MIN, $value);
        }
        return $errors;
    }

    /**
     * @param string $service
     * @return string
     */
    public static function unique(string $service): string
    {
        $result = self::findByColumn($service);
        if (sizeof($result) > 0)
            return Message::UNIQUE;
        return '';
    }

    /**
     * @param string $service
     * @return array
     */
    private static function findByColumn(string $service): array
    {
        $object = new $service;
        if (method_exists($object, 'findByColumn')) {
            return $object->findByColumn(self::$key, self::$value);
        }
        return [];
    }

    /**
     * @param string $pattern
     * @return string
     */
    public static function regex(string $pattern): string
    {
        $matches = self::validateRegex($pattern, self::$value);
        return self::parseRegex($pattern, $matches);
    }

    /**
     * @param $pattern
     * @param $subject
     * @return array
     */
    private static function validateRegex($pattern, $subject): array
    {
        if (!str_starts_with($pattern, '(')) $pattern = '/^' . $pattern . '$/';

        preg_match_all($pattern, $subject, $matches);

        return $matches[0];
    }

    /**
     * @param string $pattern
     * @param array $matches
     * @return string
     */
    private static function parseRegex(string $pattern, array $matches): string
    {
        if (
            str_contains($pattern, 'A-z') &&
            str_contains($pattern, '0-9') &&
            sizeof($matches) < 2
        ) {
            return Message::LETTER_AND_NUMBER;
        }
        if (
            (str_contains($pattern, 'A-z') ||
                str_contains($pattern, 'А-я')) &&
            sizeof($matches) == 0
        ) {
            return Message::LETTER;
        }
        return '';
    }

    /**
     * @param string $key
     * @return string
     */
    public static function compare(string $key): string
    {
        if (
            self::$value !== self::$data[$key]
        ) {
            return Message::REPEAT;
        }
        return '';
    }

    /**
     * @param string $key
     * @return string
     */
    public static function is(string $key): string
    {
        if (method_exists(self::class, $key)) {
            return self::{$key}();
        }
        return '';
    }

    /**
     * @return string
     */
    public static function email(): string
    {
        $matches = self::validateRegex('\w+@\w+\.[A-z]{2,}', self::$value);
        if (sizeof($matches) == 0) {
            return Message::EMAIL;
        }
        return '';
    }

    /**
     * @param string $service
     * @return string
     */
    public static function isset(string $service): string
    {
        $result = self::findByColumn($service);
        if (sizeof($result) == 0)
            return Message::ISSET;
        return '';
    }

    /**
     * @param string $bool
     * @return string
     */
    public static function request(string $bool): string
    {
        $errors = '';
        if (
            ($bool && strlen(self::$value) < 1) ||
            (str_contains(self::$value, ' '))
        ) {
            $errors = Message::REQUEST;
        }
        return $errors;
    }
}