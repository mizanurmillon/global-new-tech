<?php

use App\Http\Controllers\Web\backend\SecurityAssessment\SecurityAssessmentController;
use App\Http\Controllers\Web\Backend\Service\ComprServicesController;
use Illuminate\Support\Facades\Route;



Route::prefix('compr-services')->name('admin.compr-services.')->group(function () {
    Route::resource('/', ComprServicesController::class)->parameter('', 'compr-service');
    Route::patch('/status/{compr_service}', [ComprServicesController::class, 'status'])->name('status');
});

Route::prefix('security-assessment')->name('admin.security-assessment.')->group(function () {
   Route::resource('/', SecurityAssessmentController::class)->parameter('', 'security-assessment');
   Route::post('/assigned-to/{security_assessment}', [SecurityAssessmentController::class, 'assignedTo'])->name('assigned-to');
});