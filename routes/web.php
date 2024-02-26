<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DoctorController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\SurgeryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\InsuranceController;
use App\Http\Controllers\admin\OperationController;
use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\DoctorRoleController;
use App\Http\Controllers\admin\SpecialityController;
use App\Http\Controllers\admin\ActivityLogController;
use App\Http\Controllers\admin\auth\LogoutController;
use App\Http\Controllers\admin\auth\PasswordController;
use App\Http\Controllers\admin\DoctorSurgeryController;

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
Route::get('test', function(){
    return view('test');
});

Route::post('/', [LoginController::class, 'loginPost'])->name('login.post');
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('PerventLogin');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => 'CheckLoggedIn'], function(){
    Route::get('test', [DashboardController::class, 'test'])->name('test');

    Route::get('profile/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('users', UserController::class);

    Route::delete('specialities/{speciality}', [SpecialityController::class, 'destroy'])->name('specialities.destroy');
    Route::resource('specialities', SpecialityController::class);

    Route::get('doctors/search', [DoctorController::class, 'search'])->name('doctors.search');
    Route::delete('doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::resource('doctors', DoctorController::class);

    Route::delete('doctor-roles/{doctor-role}', [DoctorRoleController::class, 'destroy'])->name('doctor-roles.destroy');
    Route::resource('doctor-roles', DoctorRoleController::class);

    Route::delete('operations/{operation}', [OperationController::class, 'destroy'])->name('operations.destroy');
    Route::resource('operations', OperationController::class);

    Route::delete('insurances/{insurance}', [InsuranceController::class, 'destroy'])->name('insurances.destroy');
    Route::resource('insurances', InsuranceController::class);

    Route::delete('surgeries/{surgery}', [SurgeryController::class, 'destroy'])->name('surgeries.destroy');
    Route::resource('surgeries', SurgeryController::class);

    Route::get('activity-logs/search', [ActivityLogController::class, 'search'])->name('activity-logs.search');
    Route::delete('activity-logs/{activity-log}', [ActivityLogController::class, 'destroy'])->name('activity-logs.destroy');
    Route::resource('activity-logs', ActivityLogController::class);

    Route::post('doctor-surgeries/create', [DoctorSurgeryController::class, 'create'])->name('doctor-surgeries.create');
    Route::delete('doctor-surgeries/{doctor-surgery}', [DoctorSurgeryController::class, 'destroy'])->name('doctor-surgeries.destroy');
    Route::resource('doctor-surgeries', DoctorSurgeryController::class);

    Route::delete('invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::resource('invoices', InvoiceController::class);
    Route::get('invoices/{invoice}/description', [InvoiceController::class, 'description'])->name('invoices.description');

    Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    Route::resource('payments', PaymentController::class);

    Route::put('/change-password', [PasswordController::class, 'update'])->name('change-password');

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('settings/{setting}', [SettingController::class, 'edit'])->name('settings.edit');
    Route::patch('settings', [SettingController::class, 'update'])->name('settings.update');
})->name('admin');