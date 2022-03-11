<?php

use App\Http\Controllers\Auth\PassportController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SchoolController;
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

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [PassportController::class, 'logout']);


    /**
     *     School route group controller
     */

    Route::controller(SchoolController::class)->prefix('schools')->group(function () {
        Route::get('/index', 'indexSchools')->name('index.schools');
        Route::post('/store', 'storeSchools')->name('store.schools');
        Route::get('/{school}', 'showSchools')->name('show.schools');
        Route::put('/{school}/update', 'updateSchools')->name('update.schools');
        Route::delete('{school}/delete', 'destroySchools')->name('destroy.schools');
    });


    /**
     *     Country route group controller
     */

    Route::controller(CountryController::class)->prefix('country')->group(function () {
        Route::get('/index', 'indexCountry')->name('index.country');
        Route::post('/store', 'storeCountry')->name('store.country');
        Route::get('/{country}', 'showCountry')->name('show.country');
        Route::put('/{country}/update', 'updateCountry')->name('update.country');
        Route::delete('{country}/delete', 'destroyCountry')->name('destroy.country');
    });


    /**
     *     Campus route group controller
     */

    Route::controller(CampusController::class)->prefix('campus')->group(function () {
        Route::get('/index', 'indexCampus')->name('index.campus');
        Route::post('/{school}/{country}/store', 'storeCampus')->name('store.campus');
        Route::get('/{campus}', 'showCampus')->name('show.campus');
        Route::put('/{campus}/update', 'updateCampus')->name('update.campus');
        Route::delete('{campus}/delete', 'destroyCampus')->name('destroy.campus');
    });
});


Route::post('/login', [PassportController::class, 'login']);
