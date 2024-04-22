<?php

use App\Models\Car;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CarController::class, 'index']);

Route::get('cars/add', [CarController::class, 'create'])->middleware('auth');

Route::post('cars/store', [CarController::class, 'store'])->middleware('auth');

Route::get('cars/manage', [CarController::class, 'manage'])->middleware('auth');

Route::get('cars/{car}/edit', [CarController::class, 'edit'])->middleware('auth');

Route::put('cars/{car}', [CarController::class, 'update'])->middleware('auth');

Route::delete('cars/{car}', [CarController::class, 'delete'])->middleware('auth');

Route::get('cars/{car}', [CarController::class, 'show']);

Route::get('register', [UserController::class, 'create']);

Route::post('user', [UserController::class, 'store']);

Route::get('login', [UserController::class, 'login'])->name('login');

Route::post('user/authenticate', [UserController::class, 'authenticate']);

Route::post('logout', [UserController::class, 'logout'])->middleware('auth');

Route::post('rate/user/{user}', [RateController::class, 'rate'])->middleware('auth');

Route::delete('reviews/{review}', [ReviewController::class, 'delete'])->middleware('auth');

Route::post('reviews/cars/{car}', [ReviewController::class, 'comment'])->middleware('auth');

Route::get('getblockeddays', [Reservation::class, 'getBlockedDays'])->name('getblockeddays');

Route::get('searchresult', [Car::class, 'getSearchResults'])->name('searchresult');

Route::post('reservations/cars/{car}', [ReservationController::class, 'store']);

Route::get('reservations/cars/{car}', [ReservationController::class, 'reserve']);

Route::get('reservations/manage', [ReservationController::class, 'manage'])->middleware('auth');

Route::get('reservations/{reservation}', [ReservationController::class, 'show'])->middleware('auth');

Route::get('advanced-search', [CarController::class, 'search']);
