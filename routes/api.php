<?php

use App\Http\Controllers\API\IrigationController;
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
    Route::get('/plantation-group/{id}', [MasterGroupController::class, 'plantationGroupShow']);

    Route::get('/area', [MasterGroupController::class, 'area']);
    Route::get('/area/{id}', [MasterGroupController::class, 'areaShow']);

    Route::get('/location', [MasterGroupController::class, 'location']);
    Route::get('/location/{id}', [MasterGroupController::class, 'locationShow']);

    Route::get('/section', [MasterGroupController::class, 'section']);
    Route::get('/section/{id}', [MasterGroupController::class, 'sectionShow']);

    Route::get('/irigation', [IrigationController::class, 'list']);
});

Route::get('node/store', [ApiController::class, 'storeNode']);
Route::post('node/post', [ApiController::class, 'storeNode']);
