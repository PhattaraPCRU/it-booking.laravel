<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingRoomController;
use App\Http\Controllers\SectsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StaffUsersController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\AssetGroupController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetLocationController;

use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    $events = HomeController::fetchEvent();

    return view('welcome', ['events' => $events]);
})->name('welcome');

Auth::routes();

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/staff/logout', [LoginController::class, 'staffLogout'])->name('staff.logout');

// Home Routes
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Staff Routes
Route::middleware('auth:staff')->group(function () {
    Route::get('/staff', [StaffUsersController::class, 'index'])->name('staff.index');
    Route::get('/staff/homestaff', [StaffUsersController::class, 'homestaff'])->name('staff.homestaff');
    Route::get('/staff/create', [StaffUsersController::class, 'create'])->name('staff.create');
    Route::post('/staff/store', [StaffUsersController::class, 'store'])->name('staff.store');
    Route::get('/staff/{id}/edit', [StaffUsersController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/{id}', [StaffUsersController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{id}', [StaffUsersController::class, 'destroy'])->name('staff.destroy');
    // Route::get('/staff/review', [ReviewController::class, 'index_pending'])->name('staff.review');
    Route::get('/staff/bookingall', [StaffUsersController::class, 'index_all'])->name('staff.bookingall');
    // Route::get('/staff/approvel', [StaffUsersController::class, 'approve'])->name('staff.approve');


});

// Booking Routes
Route::middleware('auth')->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('bookings');
    Route::get('/booking/create', [BookingController::class, 'create'])->name('bcreate');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('bstore');
    Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}', [BookingController::class, 'update'])->name('bupdate');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('bdestroy');

    // Booking POST Routes
    Route::post('/booking/send', [BookingController::class, 'send'])->name('booking.send');
    Route::post('/booking/unsent', [BookingController::class, 'unsent'])->name('booking.unsent');
    Route::patch('/booking/cancel/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');


});

// Guest Routes
Route::get('/images/{filename}', [RoomController::class, 'showImageRoom'])->name('room.image');
Route::get('/images/{filename}', [RoomController::class, 'showImage'])->name('room.image');
Route::get('/rooms/search', [RoomController::class, 'search'])->name('rooms.search');
Route::get('/room/show', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/room/detail/{id}', [RoomController::class, 'detail'])->name('rooms.detail');

Route::middleware('auth:staff')->group(function () {
    Route::get('/room', [RoomController::class, 'index'])->name('rooms');
    Route::get('/room/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/room/store', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/room/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/room/{id}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/room/{id}', [RoomController::class, 'destroy'])->name('roomsdestroy');
    Route::get('/room/roomasset/{id}', [RoomController::class, 'roomasset'])->name('room.roomasset');
});

// Booking Room Routes
Route::middleware('auth:web')->group(function () {
    Route::get('/bookingroom', [BookingRoomController::class, 'index'])->name('bookingroom');
    Route::get('/bookingroom/create', [BookingRoomController::class, 'create'])->name('bookingroom.create');
    Route::post('/bookingroom/{id}/store', [BookingRoomController::class, 'store'])->name('bookingroom.store');
    Route::get('/bookingroom/{id}/edit', [BookingRoomController::class, 'edit'])->name('bookingroom.edit');
    Route::put('/bookingroom/{id}', [BookingRoomController::class, 'update'])->name('bookingroom.update');
    Route::delete('/booking/{booking_id}/{no}/destroy', [BookingRoomController::class, 'destroy'])->name('bkdestroy');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/review/index', [ReviewController::class, 'index_pending'])->name('review.index');
    Route::get('/review/indexsuccess', [ReviewController::class, 'index_success'])->name('review.indexsuccess');
    Route::patch('/booking/review/{id}', [BookingController::class, 'review'])->name('booking.review');

});


// Asset Type
Route::middleware('auth:staff')->group(function () {
Route::resource('assettype', AssetTypeController::class);
Route::resource('assetgroup', AssetGroupController::class);
Route::resource('assets', AssetController::class);
Route::resource('assetlocation', AssetLocationController::class);
});
Route::get('/calendar', function () {
    return view('calendar');
});


// Sects Routes
Route::get('/get-sects/{department_code}', [SectsController::class, 'getSects'])->name('getSects');
Route::post('/fetch-sects/{department_code}', [AssetLocationController::class, 'getSects'])->name('assetlocation.fetch');