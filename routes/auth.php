<?php

/*
|--------------------------------------------------------------------------
| API Auth Routes
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientsController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/inscription', [PatientsController::class, 'api_store'])->name('api.register');
Route::middleware('auth:api')->group(function () {
Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
Route::get('/user', [AuthController::class, 'user'])->name('api.user');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('api.resetPassword');
});
