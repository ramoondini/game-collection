<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CollectionController;

Route::get('/', [GameController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('games.index');
})->middleware('auth')->name('dashboard');

Route::get('/games', [GameController::class, 'index'])->name('games.index');

Route::get('/collections', [CollectionController::class, 'index'])
    ->name('collections.index');

Route::get('/collections/{user}', [CollectionController::class, 'show'])
    ->name('collections.show');
Route::middleware('auth')->group(function () {
    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');

    Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');

    Route::post('/games/{game}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/games/{game}/ratings', [RatingController::class, 'store'])->name('ratings.store');
});

Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');

require __DIR__.'/auth.php';