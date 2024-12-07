<?php

use App\Http\Controllers\GuestBookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RolePermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [BookingController::class, 'publicCalendar'])->name('public-calendar');


Route::get('/home', [App\Http\Controllers\Controller::class, 'noPermission']);

Auth::routes();

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('employees', EmployeeController::class)->except(['show']);
    Route::resource('bookings', BookingController::class)->except(['show']);
});

// Guest Booking Routes
Route::get('/guest-bookings/create', [GuestBookingController::class, 'create'])->name('guest-bookings.create');
Route::post('/guest-bookings/store', [GuestBookingController::class, 'store'])->name('guest-bookings.store');
Route::get('/guest-bookings/success', [GuestBookingController::class, 'success'])->name('guest-bookings.success');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/assign-roles', [RolePermissionController::class, 'index'])->name('assign.roles');
    Route::post('/assign-roles', [RolePermissionController::class, 'store'])->name('assign.roles.store');


    Route::get('/users-with-roles', [RolePermissionController::class, 'viewUsersWithRoles'])->name('users.roles.view');
    Route::get('/roles', [RolePermissionController::class, 'viewRoles'])->name('roles.view');
    Route::get('/permissions', [RolePermissionController::class, 'viewPermissions'])->name('permissions.view');
});

Route::get('/calendar', [BookingController::class, 'publicCalendar'])->name('calendar');
