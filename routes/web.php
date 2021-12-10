<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\UserController;
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
        Route::get('/create', [LahanController::class, 'create'])->name('map.create');
        Route::post('/store', [LahanController::class, 'store'])->name('map.store');
        Route::get('/{lahan}', [LahanController::class, 'show'])->name('map.show');
        Route::get('/{lahan}/edit', [LahanController::class, 'edit'])->name('map.edit');
        Route::put('/update/{lahan}', [LahanController::class, 'update'])->name('map.update');
        Route::delete('/delete/{lahan}', [LahanController::class, 'delete'])->name('map.delete');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.list');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
    });
    Route::get('/test', function () {
        return auth()->user()->id;
    });
});

Route::prefix('data')->group(function () {
    Route::get('map-list', [LahanController::class, 'list']);
});

Route::get('test', function () {
    return App\Models\User::all()->count() + 1;
});

require __DIR__ . '/auth.php';
