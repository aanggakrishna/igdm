<?php

use App\Http\Controllers\ProfileController;
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
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::get('/instagram-messages', [\App\Http\Controllers\InstagramMessageController::class, 'index'])->name('instagram.index');
});

// Legal Pages
Route::view('/privacy-policy', 'privacy')->name('privacy');
Route::view('/terms-of-service', 'terms')->name('terms');


require __DIR__.'/auth.php';


