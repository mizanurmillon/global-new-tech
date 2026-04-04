<?php

use App\Http\Controllers\Api\V1\SecurityAssessmentController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::controller(SecurityAssessmentController::class)->group(function () {
        Route::post('/security-assessment', 'store');
    });
});