<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/', HomeController::class)->name('home');
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking}/confirmation', [BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::get('/admin/login', [AdminController::class, 'login'])->name('login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
	Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
	Route::patch('/bookings/{booking}/status', [AdminController::class, 'updateStatus'])->name('admin.bookings.status');
	Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
