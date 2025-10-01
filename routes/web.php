<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BookingController;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/playstation/{playstation}', [LandingController::class, 'show'])->name('playstation.show');

// API routes for booking (exempt from CSRF)
Route::post('/api/booking', [BookingController::class, 'store'])->name('booking.store')->withoutMiddleware(['web']);
Route::post('/api/calculate-price', [BookingController::class, 'calculatePrice'])->name('booking.calculate-price')->withoutMiddleware(['web']);
