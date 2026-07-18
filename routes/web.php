<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});
// accounts routes
// Route::get('/accounts',[AccountController::class, 'index'])->name('accounts.index');
// Route::post('/accounts',[AccountController::class, 'store'])->name('accounts.store');
// Route::get('/accounts/search',[AccountController::class, 'search'])->name('accounts.search');
// Route::get('/accounts/{id}/edit',[AccountController::class, 'edit'])->name('accounts.edit');
// Route::put('/accounts/{id}',[AccountController::class, 'update'])->name('accounts.update');
// Route::delete('/accounts/{id}',[AccountController::class, 'destroy'])->name('accounts.destroy');
Route::controller(AccountController::class)->group(function () {
    Route::get('/accounts', 'index')->name('accounts.index');
    Route::post('/accounts', 'store')->name('accounts.store');
    Route::get('/accounts/search', 'search')->name('accounts.search');
    Route::get('/accounts/{id}/edit', 'edit')->name('accounts.edit');
    Route::put('/accounts/{id}', 'update')->name('accounts.update');
    Route::delete('/accounts/{id}', 'destroy')->name('accounts.destroy');    
});
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');