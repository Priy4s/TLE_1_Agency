<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

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
Route::delete('/job/{id}/waitlist', [JobController::class, 'leaveWaitlist'])->name('job.leaveWaitlist');

Route::get('/managerdashboard', [JobListingController::class, 'managerDashboard'])->name('manager.dashboard')->middleware('auth');
Route::get('/joblistings/{id}/manage', [JobController::class, 'manageDetails'])->name('job_listings.manage');
Route::get('/joblistings/{id}/hire', [JobController::class, 'hirePage'])->name('job.hire')->middleware('auth');
Route::post('/job/{id}/hire/confirm', [JobController::class, 'confirmHire'])->name('job.confirmHire')->middleware('auth');

Route::get('/quiz/start', [QuizController::class, 'startQuiz'])->name('quiz.start');
Route::get('/quiz/result', [QuizController::class, 'viewResult'])->name('quiz.result');

Route::get('/quiz/{questionIndex?}', [QuizController::class, 'showQuiz'])->name('quiz.show');
Route::post('/quiz/{questionIndex}', [QuizController::class, 'saveAnswer'])->name('quiz.save');
