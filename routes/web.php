<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Models\Question;
use Illuminate\Support\Facades\Route;

// 🚦 ROUTES: The Map of Your Website
// Think of this file as the concierge at a building entrance.
// It decides which "Controller" (Office) handles each "URL" (Visitor request).

// 1. The Home Route (GET /)
// "If someone visits the main door ('/'), send them to the PageController's 'home' office."
// ->name('home'): Giving routes names is great! It's like giving a nickname to a location.
// In your code, you can just say route('home') instead of remembering the URL.
Route::get('/', [PageController::class, 'home'])->name('home');

// 2. The Question Detail Route (GET /questions/{question})
// {question} is a WILDCARD or PARAMETER.
// If someone visits /questions/5, Laravel grabs "5".
// 
// 🔑 KEY CONCEPT: Route Model Binding
// Because we used `{question}` here, and `show(Question $question)` in the controller,
// Laravel AUTOMATICALLY finds the Question with ID=5 for us. Magic! 🎩
Route::get('questions/{question}', [QuestionController::class, 'show'])->name('questions.show');

// 3. Authenticated Routes
// These routes are protected by a bouncer (Middleware).
// Only users with an ID badge (Logged in) can pass.

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
