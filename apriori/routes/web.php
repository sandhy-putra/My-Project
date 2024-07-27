<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


// Middleware auth untuk membatasi akses
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function() {
        return view('home');
    })->name('home');

    Route::get('/', [TransactionController::class, 'index']);
    Route::get('/transaction', [TransactionController::class, 'index']);
    Route::post('/transaction_store', [TransactionController::class, 'storeTransaction']);
    Route::get('/transaction_analyze', [TransactionController::class, 'analyzeTransaction']);
    Route::post('/transaction_apriori', [TransactionController::class, 'executeApriori']);
    Route::get('/transaction_visualyze', [TransactionController::class, 'visualyzeApriori']);
    Route::get('/transaction_recap', [TransactionController::class, 'recapTransaction']);
    Route::get('/transaction_destroy', [TransactionController::class, 'destroy']);
    Route::post('/transaction_getApriori', [TransactionController::class, 'getApriori']);
});