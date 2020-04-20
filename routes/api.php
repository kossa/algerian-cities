<?php

Route::prefix('api')
    ->middleware('api')
    ->namespace('\Kossa\AlgerianCities\Controllers\Api')
    ->group(function () {
        // wilayas
        Route::get('wilayas', 'WilayaController@index'); // get all wilayas
        Route::get('wilayas/{id}', 'WilayaController@show');
        Route::get('wilayas/{id}/communes', 'WilayaController@communes');

        // Communes
        Route::get('communes', 'CommuneController@index');
        Route::get('communes/{id}', 'CommuneController@show');

        // search
        Route::get('search/wilaya/{q}', 'WilayaController@search');
        Route::get('search/commune/{q}', 'CommuneController@search');
    });
