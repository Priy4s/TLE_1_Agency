<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
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
Route::get('/quiz/start', [QuizController::class, 'startQuiz'])->name('quiz.start');
Route::get('/quiz/result', [QuizController::class, 'viewResult'])->name('quiz.result');

Route::get('/quiz/{questionIndex?}', [QuizController::class, 'showQuiz'])->name('quiz.show');
Route::post('/quiz/{questionIndex}', [QuizController::class, 'saveAnswer'])->name('quiz.save');




Route::resource('joblistings', JobListingController::class)->names([
    'index' => 'job_listings.index',
    'create' => 'job_listings.create',
    'store' => 'job_listings.store',
])->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/my-job-listings', [JobListingController::class, 'myJobListings'])->name('job_listings.my');
});

Route::get('/job/{id}', [JobController::class, 'show'])->name('job.show');

// Waitlist routes
Route::post('/job/{id}/waitlist', [JobController::class, 'joinWaitlist'])->name('job.joinWaitlist');
Route::delete('/job/{id}/waitlist', [JobController::class, 'leaveWaitlist'])->name('job.leaveWaitlist');

