<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\SocialAuthController;
use App\Http\Controllers\Api\V1\BlogController;
use App\Http\Controllers\Api\V1\CmsContentController;
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Web\Backend\Settings\DynamicPageController;
use Illuminate\Support\Facades\Route;

// API v1 routes --------------------------------------------------------------------------
Route::prefix('v1')->group(function () {
    // User Register ----------------------------------------------------------------------
    Route::middleware('throttle:5,1')->controller(RegisterController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('resend-otp', 'resendOtp');
        Route::post('verify-otp', 'verifyRegisterOtp');
    });

    // User Login -------------------------------------------------------------------------
    Route::middleware('throttle:5,1')->controller(LoginController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('forgot-password', 'forgotPassword');
        Route::post('verify-reset-otp', 'verifyOtp');
        Route::post('reset-resend-otp', 'resendOtp');
        Route::post('reset-password', 'resetPassword');
    });

    // Social Login -------------------------------------------------------------------------
    Route::post('social-login', [SocialAuthController::class, 'socialLogin'])->middleware('throttle:5,1');

    // Dynamic Page-------------------------------------------------------------------------
    Route::get('dynamic-page/{slug}', action: [DynamicPageController::class, 'dynamicPageforApp']);

    // CMS Content ------------------------------------------------------------------------
    Route::prefix('cms')->controller(CmsContentController::class)->group(function () {
        Route::get('/page/{page}', 'getPageContent');
        Route::get('/page/{page}/section/{section}', 'getSectionContent');
    });

    Route::get('blogs', [BlogController::class, 'index']);
    Route::get('blogs/{blog}', [BlogController::class, 'show']);

    Route::get('services', [ServiceController::class, 'index']);
    Route::get('services/{service}', [ServiceController::class, 'show']);

    // Protected routes -------------------------------------------------------------------
    Route::middleware(['auth:sanctum', 'enabled'])->group(function () {
        // Authenticated User -------------------------------------------------------------
        Route::controller(AuthController::class)->group(function () {
            Route::apiResource('users', AuthController::class)->only(['index', 'show', 'destroy']);
            Route::post('change-password', 'changePassword');
            Route::post('update-profile', 'updateProfile');
            Route::get('profile', 'profile');
            Route::post('logout', 'logout');
            Route::post('logout-all', 'logoutAll');
        });
    });

});
