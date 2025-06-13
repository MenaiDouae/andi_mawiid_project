<?php

use App\Http\Controllers\PatientsController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SpecialitiesController;
use App\Http\Controllers\VillesController;

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
    return Inertia::render('Welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| Services
|--------------------------------------------------------------------------
*/
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
/*
|--------------------------------------------------------------------------
| Regions
|--------------------------------------------------------------------------
*/
Route::get('/regions', [RegionsController::class, 'index'])->name('regions.index');
/*
|--------------------------------------------------------------------------
| Villes
|--------------------------------------------------------------------------
*/
Route::get('/villes',[VillesController::class ,'index'])->name('villes.index');
/*
|--------------------------------------------------------------------------
| Specialities
|--------------------------------------------------------------------------
*/
Route::get('/specialities',[SpecialitiesController::class ,'index'])->name('specialities.index');
/*
|--------------------------------------------------------------------------
| Patients
|--------------------------------------------------------------------------
*/
Route::get('/patients',[PatientsController::class ,'index'])->name('patients.index');