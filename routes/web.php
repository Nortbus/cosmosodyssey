<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PricelistController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

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

Route::get('/', [FlightController::class,'routes'])->name('routes');

Route::get('/providers/{routeid}', [FlightController::class,'providers'])->name('providers');
Route::get('/providers/book/{provider}', [FlightController::class,'book'])->name('book');

Route::get('/update', [PricelistController::class,'store'])->name('update')->middleware('throttle:1,1');;

Route::post('/reserv', [ReservationController::class,'store'])->name('store');
Route::get('/mybookings', [ReservationController::class,'show'])->name('reserve.show');
Route::get('/allbookings', [ReservationController::class,'admin'])->name('admin')->middleware('auth');

Route::get('/login', [LoginController::class,'show'])->name('login.show');
Route::post('/login', [LoginController::class,'login'])->name('login');

Route::post('/logout', [LogoutController::class,'logout'])->name('logout');



