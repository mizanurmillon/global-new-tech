<?php

use App\Http\Controllers\Web\Backend\Services\ComprServicesController;
use Illuminate\Support\Facades\Route;




Route::prefix('compr-services')->name('admin.compr-services.')->group(function () {
    Route::resource('/', ComprServicesController::class)->parameter('', 'compr-service');
    Route::patch('/status/{compr_service}', [ComprServicesController::class, 'status'])->name('status');
});