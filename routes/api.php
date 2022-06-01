<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('simulators')
    ->namespace('\App\Http\Controllers')
    ->group(function() {
        Route::post('raw', 'Simulators@raw');
        Route::post('lci', 'Simulators@lci');
        Route::post('lca', 'Simulators@lca');
        Route::post('cdb', 'Simulators@cdb');
        Route::post('lc', 'Simulators@lc');
    });
