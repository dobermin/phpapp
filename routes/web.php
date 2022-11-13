<?php

use app\Controllers\Controller;
use app\Core\Route;

Route::get('/', [Controller::class, 'index']);
Route::get('/signup', [Controller::class, 'registration']);
Route::get('/login', [Controller::class, 'login']);
Route::get('/logout', [Controller::class, 'logout']);
Route::post('/signup', [Controller::class, 'signup']);
Route::post('/login', [Controller::class, 'enter']);