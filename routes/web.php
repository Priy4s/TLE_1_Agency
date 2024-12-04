<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobListingController;
use Illuminate\Support\Facades\Route;

// Other routes remain the same
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';

// Use only one Route::resource definition for job_listings
Route::resource('joblistings', JobListingController::class)->names([
    'index' => 'job_listings.index',
    'create' => 'job_listings.create',
    'store' => 'job_listings.store',
]);
