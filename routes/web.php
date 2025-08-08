<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/items', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('items');
Route::post('/items/add', [ItemController::class, 'store'])->middleware(['auth', 'verified'])->name('items.store');
Route::get('/items/data', [ItemController::class, 'data'])->middleware(['auth', 'verified'])->name('items.data');
Route::post('/items/edit', [ItemController::class, 'edit'])->middleware(['auth', 'verified'])->name('items.edit');
Route::post('/items/update', [ItemController::class, 'update'])->middleware(['auth', 'verified'])->name('items.update');
Route::post('/items/delete', [ItemController::class, 'destroy'])->middleware(['auth', 'verified'])->name('items.destroy');

Route::get('/transactions', [TransactionController::class, 'index'])->middleware(['auth', 'verified'])->name('transactions');
Route::get('/transactions/data', [TransactionController::class, 'data'])->middleware(['auth', 'verified'])->name('transactions.data');
Route::post('/transactions/store', [TransactionController::class, 'store'])->middleware(['auth', 'verified'])->name('transactions.store');

Route::get('/items', function () {
    return view('items');
})->middleware(['auth', 'verified'])->name('items');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
