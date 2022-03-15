<?php

use App\Http\Controllers\LahanController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Area\AreaList;
use App\Http\Livewire\Dashbaord;
use App\Http\Livewire\Irigation\CreateIrigation;
use App\Http\Livewire\Irigation\DetailIrigation;
use App\Http\Livewire\Irigation\ListIrigation;
use App\Http\Livewire\Irigation\SelectIrigation;
use App\Http\Livewire\Location\CreateLocation;
use App\Http\Livewire\Location\LocationList;
use App\Http\Livewire\Map\MapList;
use App\Http\Livewire\PlantationGroup\PgCreate;
use App\Http\Livewire\PlantationGroup\PGList;
use App\Http\Livewire\PlantationGroup\PgShow;
use App\Http\Livewire\Profile\ProfileShow;
use App\Http\Livewire\Section\CreateSection;
use App\Http\Livewire\Section\SelectSection;
use App\Mail\RegisterMail;
use App\Models\MasterGroup;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
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
    Route::get('dashboard', Dashbaord::class)->name('dashboard');

    // -----------------------------------------------------------------------------------  //
    // -------------------------------------PROFILE---------------------------------------  //
    // -----------------------------------------------------------------------------------  //

    Route::get('profile', ProfileShow::class)->name('profile.show');

    Route::group(['as' => 'map.'], function () {
        Route::get('/plantation-group', PGList::class)->name('pg.list');
        Route::get('/plantation-group/create', PgCreate::class)->name('pg.create');
        Route::post('/plantation-group/store', [LahanController::class, 'pgCreate'])->name('pg.store');
        Route::get('/plantation-group/{id}', PgShow::class)->name('pg.show');

        Route::get('area', AreaList::class)->name('area.list');

        Route::get('location', LocationList::class)->name('location.list');
        Route::get('location/create', CreateLocation::class)->name('location.create');

        Route::group(['prefix' => 'section'], function () {
            Route::get('/', MapList::class)->name('section.list');
            Route::get('/selection', SelectSection::class)->name('section.selection');
            Route::get('/create/{pg}/{area}/{location}', CreateSection::class)->name('section.create');
            Route::post('/store/{pg}/{area}/{location}', [LahanController::class, 'store'])->name('section.store');
            Route::get('/{section:master_id}', [LahanController::class, 'show'])->name('section.show');
            Route::get('/{section}/edit', [LahanController::class, 'edit'])->name('section.edit');
            Route::put('/update/{section}', [LahanController::class, 'update'])->name('section.update');
            Route::delete('/delete/{section}', [LahanController::class, 'delete'])->name('section.delete');

            Route::get('/{section}/progres', [LahanController::class, 'progres'])->name('section.progres');
            Route::post('/{section}/upload-progres', [LahanController::class, 'progresUpload'])->name('section.progres.upload');

            Route::post('/progres/{progres}', [LahanController::class, 'deleteProgres'])->name('progres.delete');
        });
    });

    Route::group(['as' => 'irigation.'], function () {
        Route::get('irigation', ListIrigation::class)->name('list');
        Route::get('irigation/detail/{data}/', DetailIrigation::class)->name('show');
        Route::get('irigation/select', SelectIrigation::class)->name('select');
        Route::get('irigation/create/{id}', CreateIrigation::class)->name('create');
        Route::post('irigation/store/{id}', [LahanController::class, 'irigationStore'])->name('store');
        Route::put('irigation/update/{id}', [LahanController::class, 'irigationUpdate'])->name('update');
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

Route::prefix('test')->group(function () {
    Route::get('/', function () {
        $section = \App\Models\Section::find(1);

        $irigations = $section->irigations;


        return $irigations->count();
    });
    Route::get('mail/send/{email}', function ($email) {
        Mail::to($email)->send(new RegisterMail('username', 'password'));

        return 'Berhasil';
    });
});

require __DIR__ . '/auth.php';
