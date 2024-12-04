<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

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



Route::get('/quiz/{questionIndex?}', [QuizController::class, 'showQuiz'])->name('quiz.show');
Route::post('/quiz/{questionIndex}', [QuizController::class, 'saveAnswer'])->name('quiz.save');
Route::get('/quiz/results', [QuizController::class, 'seeResult'])->name('quiz.result');
Route::get('/quiz/myResults', [QuizController::class, 'showSavedResults'])->name('quiz.savedResults');





require __DIR__.'/auth.php';
