<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QuotationController;

/**
 * Animesh's Routes
 * */

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('verified');

    // Route::middleware(['password.confirm'])->group(function () {
        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('settings');

        Route::get('/profile', function () {
            return view('admin.profile');
        })->name('profile');
    // });

    /*
    |--------------------------------------------------------------------------
    | PDF Routes
    |--------------------------------------------------------------------------
    */
    Route::post('billings/generate', [BillingController::class, 'createBillingsPDF'])->name('billings.generate');
    Route::resource('billings', BillingController::class);
    Route::resource('quotations', QuotationController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('receipts', ReceiptController::class);

});