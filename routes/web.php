<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Map\MapList;
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
    return redirect(route('login'));
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [Controller::class, 'dashboard'])->name('dashboard');
    Route::group(['prefix' => 'map'], function () {
        Route::get('/', MapList::class)->name('map.list');
        Route::get('/create', [LahanController::class, 'create'])->name('map.create');
        Route::post('/store', [LahanController::class, 'store'])->name('map.store');
        Route::get('/{section}', [LahanController::class, 'show'])->name('map.show');
        Route::get('/{section}/edit', [LahanController::class, 'edit'])->name('map.edit');
        Route::put('/update/{section}', [LahanController::class, 'update'])->name('map.update');
        Route::delete('/delete/{section}', [LahanController::class, 'delete'])->name('map.delete');

        Route::get('/{section}/progres', [LahanController::class, 'progres'])->name('map.progres');
        Route::post('/{section}/upload-progres', [LahanController::class, 'progresUpload'])->name('map.progres.upload');

        Route::post('/progres/{progres}', [LahanController::class, 'deleteProgres'])->name('progres.delete');
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
    Route::get('geojson/{section}', [LahanController::class, 'geojson'])->name('geojson');
});

Route::get('test', function () {
    return App\Models\User::all()->count() + 1;
});

require __DIR__ . '/auth.php';
