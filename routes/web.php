<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Other routes remain the same
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::resource('joblistings', JobListingController::class)->names([
    'index' => 'job_listings.index',
    'create' => 'job_listings.create',
    'store' => 'job_listings.store',
])->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/my-job-listings', [JobListingController::class, 'myJobListings'])->name('job_listings.my');
});

Route::get('/job/{id}', [JobController::class, 'show'])->name('job.show');

// Route to join the waitlist
Route::post('/job/{id}/waitlist', [JobController::class, 'joinWaitlist'])->name('job.joinWaitlist');
Route::get('/managerdashboard', [JobListingController::class, 'managerDashboard'])->name('manager.dashboard')->middleware('auth');
Route::get('/joblistings/{id}/manage', [JobController::class, 'manageDetails'])->name('job_listings.manage');
