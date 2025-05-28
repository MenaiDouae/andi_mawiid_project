<?php

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\PersonnelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\RolesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Services
|--------------------------------------------------------------------------
*/

Route::get('/services', [ServicesController::class, 'api_index'])->name('services.index');
Route::post('/services', [ServicesController::class, 'api_store'])->name('services.store');
Route::get('/service/{id_service}', [ServicesController::class, 'api_show'])->name('services.show');
Route::put('/service/{id_service}', [ServicesController::class, 'api_update'])->name('services.update');
Route::delete('/service/{id_service}', [ServicesController::class, 'api_destroy'])->name('services.delete');

/*
|--------------------------------------------------------------------------
| Personnel
|--------------------------------------------------------------------------
*/

Route::get('/personnels', [PersonnelController::class, 'api_index'])->name('personnels.index');
Route::post('/personnels', [PersonnelController::class, 'api_store'])->name('personnels.store');
Route::get('/personnel/{id_personnel}', [PersonnelController::class, 'api_show'])->name('personnels.show');
Route::put('/personnel/{id_personnel}', [PersonnelController::class, 'api_update'])->name('personnels.update');
Route::delete('/personnel/{id_personnel}', [PersonnelController::class, 'api_destroy'])->name('personnels.delete');

/*
|--------------------------------------------------------------------------
| Patients
|--------------------------------------------------------------------------
*/

Route::get('/patients', [PatientsController::class, 'api_index'])->name('patients.index');
Route::post('/patients', [PatientsController::class, 'api_store'])->name('patients.store');
Route::get('/patient/{id_patient}', [PatientsController::class, 'api_show'])->name('patients.show');
Route::put('/patient/{id_patient}', [PatientsController::class, 'api_update'])->name('patients.update');
Route::delete('/patient/{id_patient}', [PatientsController::class, 'api_destroy'])->name('patients.delete');

/*
|--------------------------------------------------------------------------
| RendezVous
|--------------------------------------------------------------------------
*/

Route::get('/rendezVous',[RendezVousController::class,'api_index'])->name('rendezVous.index');
Route::post('/rendezVous',[RendezVousController::class,'api_store'])->name('rendezVous.store');
Route::get('/rendezVous/{id_rendez_vous}',[RendezVousController::class,'api_show'])->name('rendezVous.show');
Route::put('/rendezVous/{id_rendez_vous}',[RendezVousController::class,'api_update'])->name('rendezVous.update');
Route::delete('/rendezVous/{id_rendez_vous}',[RendezVousController::class,'api_destroy'])->name('rendezVous.destroy');


/*
|--------------------------------------------------------------------------
| Roles
|--------------------------------------------------------------------------
*/

Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
Route::get('/role/{id}', [RolesController::class, 'edit'])->name('roles.show');
Route::post('/roles', [RolesController::class, 'store'])->name('roles.store');
Route::put('/role/{id}', [RolesController::class, 'update'])->name('roles.update');
Route::delete('/role/{id}', [RolesController::class, 'destroy'])->name('roles.destroy');

/*
|--------------------------------------------------------------------------
| Permissions
|--------------------------------------------------------------------------
*/

Route::get('/permissions', [PermissionsController::class, 'index'])->name('permissions.index');
Route::get('/permission/{id}', [PermissionsController::class, 'edit'])->name('permissions.edit');