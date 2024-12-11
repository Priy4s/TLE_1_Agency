<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Http\Request;


Route::get('/job/confirm', [JobController::class, 'showConfirmation'])->name('job.confirm');

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('job_listings.index'); // Redirect to job listings if logged in
    } else {
        return view('welcome'); // Show welcome page if not logged in
    }
})->name('home');

Route::get('/dashboard', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('job_listings.index'); // Redirect to job listings if logged in
    } else {
        return view('dashboard'); // Show dashboard page if not logged in
    }
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

Route::get('/job/{id}', [JobController::class, 'show'])->name('job.show')->middleware('auth');

// Route to join the waitlist
Route::post('/job/{id}/waitlist', [JobController::class, 'joinWaitlist'])->name('job.joinWaitlist')->middleware('auth');
Route::delete('/job/{id}/waitlist', [JobController::class, 'leaveWaitlist'])->name('job.leaveWaitlist')->middleware('auth');
Route::get('/managerdashboard', [JobListingController::class, 'managerDashboard'])->name('manager.dashboard')->middleware('auth');
Route::get('/joblistings/{id}/manage', [JobController::class, 'manageDetails'])->name('job_listings.manage')->middleware('auth');
Route::get('/joblistings/{id}/hire', [JobController::class, 'hirePage'])->name('job.hire')->middleware('auth');
Route::post('/job/{id}/hire/confirm', [JobController::class, 'confirmHire'])->name('job.confirmHire')->middleware('auth');
Route::get('/quiz/start', [QuizController::class, 'startQuiz'])->name('quiz.start')->middleware('auth');
Route::get('/quiz/result', [QuizController::class, 'viewResult'])->name('quiz.result')->middleware('auth');
Route::get('/quiz/{questionIndex?}', [QuizController::class, 'showQuiz'])->name('quiz.show')->middleware('auth');
Route::post('/quiz/{questionIndex}', [QuizController::class, 'saveAnswer'])->name('quiz.save')->middleware('auth');
Route::patch('/waitlist/{id}/update-process', [JobController::class, 'updateProcess'])->name('waitlist.updateProcess')->middleware('auth');
Route::get('/job/{id}', [JobController::class, 'show'])->name('job.show');
Route::middleware('auth')->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{user}', [ChatController::class, 'store'])->name('chat.store');
});
Route::post('/broadcasting/auth', function (Request $request) {
    return Broadcast::auth($request);
});
Route::post('/broadcast', 'App\Http\Controllers\PusherController@broadcast');
Route::post('/receive', 'App\Http\Controllers\PusherController@receive');
