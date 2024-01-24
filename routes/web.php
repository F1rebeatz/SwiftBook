<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
Route::post('/hotels/{id}/book', [BookingController::class, 'book'])->name('bookings.store');

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::delete('/bookings/{booking}', [BookingController::class, 'remove'])->name('bookings.delete');
Route::get('/bookings/show/{booking}', [BookingController::class, 'show'])->name('bookings.show');

Route::get('/hotels/{id}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/hotels/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/hotels/{id}/reviews/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/hotels/{id}/reviews/edit', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('hotels/{id}/reviews', [ReviewController::class, 'remove'])->name('reviews.destroy');
