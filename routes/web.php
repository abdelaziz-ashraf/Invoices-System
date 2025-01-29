<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('sections', [SectionController::class, 'index'])->name('sections.index');
    Route::get('sections/{section}/get-products', [SectionController::class, 'getProducts'])->name('sections.products');

    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    Route::get('/invoices', [InvoicesController::class, 'index'])->name('invoices.index');
    Route::get('invoices/create', [InvoicesController::class, 'create'])->name('invoices.create');
    Route::post('invoices', [InvoicesController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/archive', [InvoicesController::class, 'archive'])->name('invoices.archive');
    Route::patch('/invoices/{invoice}/change-status', [InvoicesController::class, 'changeStatus'])->name('invoices.change.status');

    Route::middleware(['role:admin'])->group(function () {

        Route::controller(AdminController::class)->group(function () {
            Route::get('users', 'users')->name('admins.users');
            Route::post('admin/add-employee', 'storeEmployee')->name('admins.store.employee');
            Route::delete('admin/delete-employee/{user}', 'deleteEmployee')->name('admins.delete.employee');
        });

        Route::controller(SectionController::class)->group(function () {
           Route::post('/sections', 'store')->name('sections.store');
           Route::get('/sections/{section}/edit', 'edit')->name('sections.edit');
           Route::put('/sections/{section}', 'update')->name('sections.update');
           Route::delete('/sections/{section}', 'destroy')->name('sections.destroy');
        });

        Route::controller(InvoicesController::class)->group(function () {
            Route::get('invoices/{invoice}/edit', 'edit')->name('invoices.edit');
            Route::put('invoices/{invoice}', 'update')->name('invoices.update');
            Route::delete('invoices/{invoice}', 'destroy')->name('invoices.destroy');
            Route::put('/invoices/{id}/unarchive', 'unarchive')->name('invoices.unarchive');
            Route::get('invoices/{invoice}/print', 'print')->name('invoices.print');
        });

        Route::controller(ProductController::class)->group(function () {
            Route::post('products', 'store')->name('products.store');
            Route::get('products/{product}/edit', 'edit')->name('products.edit');
            Route::put('products/{product}', 'update')->name('products.update');
            Route::delete('products/{product}', 'destroy')->name('products.destroy');
        });
    });

});

require __DIR__.'/auth.php';
