<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;

Route::get('/', function () { return redirect('/login'); });

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (Must be logged in)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Customer Management
    Route::get('/customers/create', [CustomerController::class, 'create']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    
    // Delete Customer (New)
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
    
    // Interactions & Updates
    Route::post('/customers/{id}/interaction', [CustomerController::class, 'storeInteraction']);
    Route::post('/customers/{id}/status', [CustomerController::class, 'updateStatus']);

    // Reports (New)
    Route::get('/reports', [ReportController::class, 'index']);
});