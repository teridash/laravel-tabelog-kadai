<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CheckoutController;

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

//Route::get('/', function () {
    //return view('welcome');
//});

Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
    Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
    Route::get('users/mypage/reservations', 'reservation' )->name('mypage.reservations');
    
});

Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::resource('stores', StoreController::class)->middleware(['auth', 'verified']);
Auth::routes(['verify' => true]);


Route::resource('reservations', ReservationController::class);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('campany', [App\Http\Controllers\CampanyController::class, 'index'])->name('campany');

Route::controller(CheckoutController::class)->middleware('auth')->group(function () {
    Route::get('users/checkout', 'index')->name('checkout.index');
    Route::post('users/checkout/store', 'store')->name('checkout.store');
    Route::get('users/checkout/edit', 'edit')->middleware('subscribed')->name('checkout.edit');    
    Route::post('users/checkout/update', 'update')->middleware('subscribed')->name('checkout.update');

    Route::get('users/checkout/cancel', 'cancel')->middleware('subscribed')->name('checkout.cancel');    
    Route::post('users/checkout/delete', 'delete')->middleware('subscribed')->name('checkout.delete');
});