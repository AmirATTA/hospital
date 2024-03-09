<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Doctor\AuthController;
use App\Http\Controllers\Api\Doctor\SurgeryController;

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

Route::name('api')->prefix('doctor')->middleware('guest')->group(function() {
    Route::post('/login',[AuthController::class,'login'])->name('doctor.login');
});

Route::name('api')->prefix('doctor')->middleware('auth:doctor-api')->group(function() {
    Route::post('/logout',[AuthController::class,'logout'])->name('doctor.logout');
    
    Route::get('/surgeries',[SurgeryController::class,'index'])->name('surgeries.index');
    Route::get('/surgeries/{surgery}', [SurgeryController::class,'show'])->name('surgeries.show');
});