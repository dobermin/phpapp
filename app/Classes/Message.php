<?php

namespace app\Classes;

class Message
{
    const MIN = 'Длина поля должна быть больше или равна %s';
    const REPEAT = 'Ошибка в повторении';
    const UNIQUE = 'Поле должно быть уникальным';
    const ISSET = 'Неверное значение поля';
    const EMAIL = 'Не является email';
    const LETTER = 'Поле должно содержать только буквы';
    const LETTER_AND_NUMBER = 'Поле должно содержать буквы и цифры';
    const REQUEST = 'Поле должно быть заполнено и без пробелов';
}