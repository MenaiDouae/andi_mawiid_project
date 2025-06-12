<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\TraitementsController;
use App\Http\Controllers\VillesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// group api's under as 'api' name

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Services
|--------------------------------------------------------------------------
*/

Route::get('/services', [ServicesController::class, 'api_index'])->name('api.services.index');
Route::post('/services', [ServicesController::class, 'api_store'])->name('api.services.store');
Route::get('/service/{id_service}', [ServicesController::class, 'api_show'])->name('api.services.show');
Route::put('/service/{id_service}', [ServicesController::class, 'api_update'])->name('api.services.update');
Route::delete('/service/{id_service}', [ServicesController::class, 'api_destroy'])->name('api.services.delete');

/*
|--------------------------------------------------------------------------
| Personnel
|--------------------------------------------------------------------------
*/

Route::get('/personnels', [PersonnelController::class, 'api_index'])->name('api.personnels.index');
Route::post('/personnels', [PersonnelController::class, 'api_store'])->name('personnels.store');
Route::get('/personnel/{id_personnel}', [PersonnelController::class, 'api_show'])->name('api.personnels.show');
Route::put('/personnel/{id_personnel}', [PersonnelController::class, 'api_update'])->name('api.personnels.update');
Route::delete('/personnel/{id_personnel}', [PersonnelController::class, 'api_destroy'])->name('api.personnels.delete');

/*
|--------------------------------------------------------------------------
| Patients
|--------------------------------------------------------------------------
*/

Route::get('/patients', [PatientsController::class, 'api_index'])->name('api.patients.index');
Route::post('/patients', [PatientsController::class, 'api_store'])->name('api.patients.store');
Route::get('/patient/{id_patient}', [PatientsController::class, 'api_show'])->name('api.patients.show');
Route::put('/patient/{id_patient}', [PatientsController::class, 'api_update'])->name('api.patients.update');
Route::delete('/patient/{id_patient}', [PatientsController::class, 'api_destroy'])->name('api.patients.delete');

/*
|--------------------------------------------------------------------------
| RendezVous
|--------------------------------------------------------------------------
*/

Route::get('/rendezVous',[RendezVousController::class,'api_index'])->name('api.rendezVous.index');
Route::post('/rendezVous',[RendezVousController::class,'api_store'])->name('api.rendezVous.store');
Route::get('/rendezVous/{id_rendez_vous}',[RendezVousController::class,'api_show'])->name('api.rendezVous.show');
Route::put('/rendezVous/{id_rendez_vous}',[RendezVousController::class,'api_update'])->name('api.rendezVous.update');
Route::delete('/rendezVous/{id_rendez_vous}',[RendezVousController::class,'api_destroy'])->name('api.rendezVous.destroy');


/*
|--------------------------------------------------------------------------
| Roles
|--------------------------------------------------------------------------
*/
Route::get('/roles', [RolesController::class, 'index'])->name('api.roles.index');
Route::get('/role/{id}', [RolesController::class, 'edit'])->name('api.roles.show');
Route::post('/role', [RolesController::class, 'store'])->name('api.roles.store');
Route::put('/role/{id}', [RolesController::class, 'update'])->name('api.roles.update');
Route::delete('/role/{id}', [RolesController::class, 'destroy'])->name('api.roles.destroy');

/*
|--------------------------------------------------------------------------
| Permissions
|--------------------------------------------------------------------------
*/
Route::get('/permissions', [PermissionsController::class, 'index'])->name('api.permissions.index');
Route::get('/permission/{id}', [PermissionsController::class, 'edit'])->name('api.permissions.edit');

/*
|--------------------------------------------------------------------------
| Traitements
|--------------------------------------------------------------------------
*/
Route::get('/traitements', [TraitementsController::class, 'api_index'])->name('api.traitements.index');
Route::post('/traitements', [TraitementsController::class, 'api_store'])->name('api.traitements.store');
Route::get('/traitement/{id_traitement}', [TraitementsController::class, 'api_show'])->name('api.traitements.show');
Route::put('/traitement/{id_traitement}', [TraitementsController::class, 'api_update'])->name('api.traitements.update');
Route::delete('/traitement/{id_traitement}', [TraitementsController::class, 'api_destroy'])->name('api.traitements.destroy');
/*
|--------------------------------------------------------------------------
| Regions
|--------------------------------------------------------------------------
*/
Route::get('/regions', [RegionsController::class, 'api_index'])->name('api.regions.index');
Route::post('/region', [RegionsController::class, 'api_store'])->name('api.region.store');
Route::get('/region/{id_region}', [RegionsController::class, 'api_show'])->name('api.region.show');
Route::put('/region/{id_region}', [RegionsController::class, 'api_update'])->name('api.region.update');
Route::delete('/region/{id_region}', [RegionsController::class, 'api_destroy'])->name('api.region.delete');
/*
|--------------------------------------------------------------------------
| Villes
|--------------------------------------------------------------------------
*/
Route::get('/villes',[VillesController::class,'api_index'])->name('api.villes.index');
Route::post('/ville',[VillesController::class,'api_store'])->name('api.ville.store');
Route::get('/ville/{id_ville}',[VillesController::class,'api_show'])->name('api.ville.show');
Route::put('/ville/{id_ville}',[VillesController::class,'api_update'])->name('api.ville.update');
Route::delete('/ville/{id_ville}',[VillesController::class,'api_destroy'])->name('api.ville.delete');


