<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LahanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [Controller::class, 'dashboard'])->name('dashboard');
    Route::group(['prefix' => 'map'], function () {
        Route::get('/', [LahanController::class, 'index'])->name('map.list');
        Route::get('/{id}', [LahanController::class, 'show'])->name('map.show');
    });
});

require __DIR__ . '/auth.php';
