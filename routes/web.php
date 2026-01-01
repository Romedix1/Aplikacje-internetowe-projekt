<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/katalog', [BookController::class, 'index'])->name('books.index');
    Route::get('/ksiazka/{id}', [BookController::class, 'show'])->name('books.show');
    Route::post('/wypozycz', [LoanController::class, 'store'])->name('loans.store');
    Route::get('/moje-ksiazki', [LoanController::class, 'index'])->name('loans.index');
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('books.index');
    }
    return redirect()->route('login');
});