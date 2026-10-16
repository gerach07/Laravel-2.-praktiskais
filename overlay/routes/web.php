<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('books.index');
    })->name('dashboard');

    // AJAX maršruti (jābūt pirms resource)
    Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
    Route::patch('/books/{book}/toggle', [BookController::class, 'toggleRead'])->name('books.toggle');

    Route::resource('books', BookController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
