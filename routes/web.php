<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BookingController;



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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('employees', EmployeeController::class)->except(['show']);
        Route::resource('bookings', BookingController::class)->except(['show']);
    });

    Route::get('/view-meetings', [BookingController::class, 'index'])->name('home')->middleware('permission:view calendar')->name('show-meetings');
});
