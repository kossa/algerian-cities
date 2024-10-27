<?php

use Illuminate\Support\Facades\Route;
use Kossa\AlgerianCities\Controllers\Api\CommuneController;
use Kossa\AlgerianCities\Controllers\Api\WilayaController;

Route::prefix('api')
    ->middleware('api')
    ->group(function () {
        // Wilayas
        Route::controller(WilayaController::class)->group(function () {
            Route::get('wilayas', 'index'); // Get all wilayas
            Route::get('wilayas/{id}', 'show'); // Get specific wilaya
            Route::get('wilayas/{id}/communes', 'communes'); // Get communes by wilaya
            Route::get('search/wilaya/{q}', 'search'); // Search wilayas
        });

        // Communes
        Route::controller(CommuneController::class)->group(function () {
            Route::get('communes', 'index'); // Get all communes
            Route::get('communes/{id}', 'show'); // Get specific commune
            Route::get('search/commune/{q}', 'search'); // Search communes
        });
    });
