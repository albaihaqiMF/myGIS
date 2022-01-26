<?php

use App\Http\Controllers\API\MasterGroupController;
use App\Http\Controllers\ApiController;
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

Route::prefix('map')->group(function () {
    Route::get('/', [MasterGroupController::class, 'index']);

    Route::get('/plantation-group', [MasterGroupController::class, 'plantationGroup']);

    Route::get('/area', [MasterGroupController::class, 'area']);

    Route::get('/location', [MasterGroupController::class, 'location']);
});
