<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\CustomerController;

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
    $billingsRoute = config('billings.billing.route');

    Route::post($billingsRoute.'/generate', [BillingController::class, 'createBillingsPDF'])
    ->name('billings.generate');

    Route::resource($billingsRoute, BillingController::class);

    Route::resource(config('billings.quotation.route'), QuotationController::class);
    
    Route::resource(config('billings.customer.route'), CustomerController::class);

});