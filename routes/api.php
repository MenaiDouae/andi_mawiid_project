<?php

use App\Http\Controllers\ServicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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