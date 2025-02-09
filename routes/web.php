<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\AuthorsController;



Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware([\App\Http\Middleware\AuthCheckApi::class])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    })->name("welcome");

    Route::get('/authors', [AuthorsController::class, 'index'])->name('authors.index');
    Route::get('/authors/{id}', [AuthorsController::class, 'show'])->name('authors.show');
    Route::delete('/authors/{id}', [AuthorsController::class, 'destroy'])->name('authors.destroy');

    Route::get('/books', [BooksController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BooksController::class, 'create'])->name('books.create');
    Route::post('/books', [BooksController::class, 'store'])->name('books.store');
    Route::delete('/books/{id}', [BooksController::class, 'destroy'])->name('books.destroy');

    Route::get('/profile', [AuthController::class, 'profileShow'])->name('profile.show');
    Route::get('/profile/edit', [AuthController::class, 'profileEdit'])->name('profile.edit');
    Route::post('/profile/update', [AuthController::class, 'profileUpdate'])->name('profile.update');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

