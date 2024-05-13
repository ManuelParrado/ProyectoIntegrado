<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTableController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

Route::resource('user', UserController::class);
Route::resource('order', OrderController::class);
Route::resource('dish', DishController::class);
Route::resource('table', TableController::class)->middleware(['auth']);
Route::resource('reservations', ReservationsController::class)->middleware(['auth']);
