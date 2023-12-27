<?php

use App\Http\Controllers\BookingController;
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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
Route::post('/hotels/book', [HotelController::class, 'book'])->name('bookings.store');

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
//    Route::group(['as' => 'voyager.'], function () {
//        // Добавьте пользовательские маршруты аутентификации и регистрации, если необходимо
//        Route::get('login', [CustomVoyagerAuthController::class, 'login'])->name('login');
//        Route::post('login', [CustomVoyagerAuthController::class, 'postLogin'])->name('postlogin');
//
//        Route::get('register', [CustomVoyagerAuthController::class, 'register'])->name('register');
//        Route::post('register', [CustomVoyagerAuthController::class, 'postRegister'])->name('postregister');
//    });
});
