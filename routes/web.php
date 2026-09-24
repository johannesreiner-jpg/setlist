<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/mixes', [App\Http\Controllers\MixController::class, 'index'])->name('mixes.index');
Route::get('/mixes/{mix}', [App\Http\Controllers\MixController::class, 'show'])->name('mixes.show');

Route::post('/mixes/{mix}/comments', [App\Http\Controllers\CommentController::class, 'store'])
    ->middleware('auth')
    ->name('mixes.comments.store');

require __DIR__.'/auth.php';