<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Area\AreaList;
use App\Http\Livewire\Location\CreateLocation;
use App\Http\Livewire\Location\LocationList;
use App\Http\Livewire\Map\MapList;
use App\Http\Livewire\PlantationGroup\CreatePg;
use App\Http\Livewire\PlantationGroup\PGList;
use App\Http\Livewire\Section\CreateSection;
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

    Route::group(['as' => 'map.'], function () {
        Route::get('/plantation-group', PGList::class)->name('pg.list');

        Route::get('area', AreaList::class)->name('area.list');

        Route::get('location', LocationList::class)->name('location.list');
        Route::get('location/create', CreateLocation::class)->name('location.create');

        Route::group(['prefix' => 'section'], function () {
            Route::get('/', MapList::class)->name('section.list');
            Route::get('/create', CreateSection::class)->name('section.create');
            Route::post('/store', [LahanController::class, 'store'])->name('section.store');
            Route::get('/{section:master_id}', [LahanController::class, 'show'])->name('section.show');
            Route::get('/{section}/edit', [LahanController::class, 'edit'])->name('section.edit');
            Route::put('/update/{section}', [LahanController::class, 'update'])->name('section.update');
            Route::delete('/delete/{section}', [LahanController::class, 'delete'])->name('section.delete');

            Route::get('/{section}/progres', [LahanController::class, 'progres'])->name('section.progres');
            Route::post('/{section}/upload-progres', [LahanController::class, 'progresUpload'])->name('section.progres.upload');

            Route::post('/progres/{progres}', [LahanController::class, 'deleteProgres'])->name('progres.delete');
        });
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
