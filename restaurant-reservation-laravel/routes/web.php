<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NotificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('reservations', ReservationController::class);

// Notification management
Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::put('notifications/{notification}', [NotificationController::class, 'markAsRead'])->name('notifications.update');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('menus', MenuController::class);
    Route::resource('users', UserController::class);
});
