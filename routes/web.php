<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('sections', \App\Http\Controllers\SectionController::class)->except(['show', 'create']);
Route::get('sections/{section}/get-products', [\App\Http\Controllers\SectionController::class, 'getProducts'])->name('sections.products');
Route::resource('products', \App\Http\Controllers\ProductController::class)->except(['show', 'create']);
Route::get('/invoices/archive', [InvoicesController::class, 'archive'])->name('invoices.archive');
Route::put('/invoices/{id}/unarchive', [InvoicesController::class, 'unarchive'])->name('invoices.unarchive');
Route::resource('invoices', InvoicesController::class)->except(['show']);

require __DIR__.'/auth.php';

Route::get('/{page}', [AdminController::class, 'index']);
