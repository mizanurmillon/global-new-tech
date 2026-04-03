<?php

use App\Http\Controllers\Web\Backend\Blog\BlogController;
use App\Http\Controllers\Web\Backend\Brand\BrandController;
use App\Http\Controllers\Web\Backend\Dashboard\DashboardController;
use App\Http\Controllers\Web\Backend\Service\CoreServiceController;
use App\Http\Controllers\Web\Backend\Service\SubServiceController;
use App\Http\Controllers\Web\Backend\Team\TeamMemberController;
use App\Http\Controllers\Web\Backend\Testimonial\TestimonialController;
use Illuminate\Support\Facades\Route;

//  Users Controller _________________________________________________________________
// Route::resource('users', UserController::class);
// Route::patch('users/{user}/role', [UserController::class, 'updateRole'])->name('users.role');
// Route::patch('users/{user}/account-status', [UserController::class, 'updateAccountStatus'])->name('users.account-status');

// Dashboard Controller _______________________________________________________

// Access for admin and team members
Route::middleware(['team'])->group(function () {
    Route::controller(DashboardController::class)->prefix('/dashboard')->group(function () {
        Route::get('/', 'index')->name('admin.dashboard');
        Route::get('/metrics', 'metrics')->name('admin.dashboard.metrics');
        Route::get('/transaction-history', 'transactionHistory');
        Route::get('/sales-chart', 'salesChart');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('blogs')->name('admin.blogs.')->group(function () {
        Route::resource('/', BlogController::class)->parameter('', 'blog');
        Route::patch('/status/{blog}', [BlogController::class, 'status'])->name('status');
    });

    Route::resource('/testimonials', TestimonialController::class)->names('admin.testimonials');
    Route::patch('/testimonials/{id}/status', [TestimonialController::class, 'status'])->name('admin.testimonials.status');

    Route::prefix('brands')->name('admin.brands.')->group(function () {
        Route::resource('/', BrandController::class)->parameter('', 'brand');
        Route::patch('/status/{brand}', [BrandController::class, 'status'])->name('status');
    });

});

// Access Only for admin ____________________________________________________________
Route::middleware(['admin'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::resource('team', TeamMemberController::class);
        Route::patch('/status/{team}', [TeamMemberController::class, 'status'])->name('team.status');
    });

    Route::prefix('services')->name('admin.services.')->group(function () {
        Route::resource('/', CoreServiceController::class)->parameter('', 'service');
        Route::patch('/status/{service}', [CoreServiceController::class, 'status'])->name('status');
    });

    Route::prefix('sub-services')->name('admin.sub-services.')->group(function () {
        Route::resource('/', SubServiceController::class)->parameter('', 'subService');
    });

});
