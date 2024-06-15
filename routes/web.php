<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::view('profile', 'profile')
    ->middleware(['auth_custom'])
    ->name('profile');

require __DIR__ . '/auth.php';

Route::resource('admin', UserController::class)->middleware(['auth_custom', 'admin']);
Route::resource('order', OrderController::class)->middleware(['auth_custom']);
Route::resource('dish', DishController::class);
Route::resource('table', TableController::class)->middleware(['auth_custom']);
Route::resource('reservations', ReservationsController::class)->middleware(['auth_custom']);
