<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\auth\LogoutController;
use App\Http\Controllers\admin\auth\PasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/', [LoginController::class, 'loginPost'])->name('login.post');
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => 'CheckLoggedIn'], function(){
    Route::get('test', [DashboardController::class, 'test'])->name('test');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('users', UserController::class);

    Route::put('/change-password', [PasswordController::class, 'update'])->name('change-password');
})->name('admin');