<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DoctorController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\SurgeryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\InsuranceController;
use App\Http\Controllers\admin\OperationController;
use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\DoctorRoleController;
use App\Http\Controllers\admin\SpecialityController;
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

    Route::get('profile/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('users', UserController::class);

    Route::delete('specialities/{speciality}', [SpecialityController::class, 'destroy'])->name('specialities.destroy');
    Route::resource('specialities', SpecialityController::class);

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

    Route::put('/change-password', [PasswordController::class, 'update'])->name('change-password');
})->name('admin');


// <div class="col-md-12">
// 	<div class="form-group m-0">
// 		<label class="form-label">مجوز ها</label>
// 		<div class="custom-controls-stacked">
// 			@foreach($permissions as $id => $label)
// 				<label class="custom-control custom-checkbox">
// 					<input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $id }}">
// 					<span class="custom-control-label">{{ $label }}</span>
// 				</label>
// 			@endforeach
// 		</div>
// 		<label class="custom-control custom-checkbox select-all">
// 			<input type="checkbox" class="custom-control-input" id="select_all">
// 			<span class="custom-control-label">انتخاب همه</span>
// 		</label>
// 	</div>
// </div>



// <div class="row">
//     <div class="col-md-12">
//         <div class="form-group m-0">
//             <label class="form-label">مجوز ها</label>
//             <div class="custom-controls-stacked">
//                 @foreach($permissions as $id => $label)
//                     <label class="custom-control custom-checkbox">
//                         <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $id }}" 
//                         @if (in_array($id, $userPermissions)) checked @endif>
//                         <span class="custom-control-label">{{ $label }}</span>
//                     </label>
//                 @endforeach
//             </div>
//             <label class="custom-control custom-checkbox select-all">
//                 <input type="checkbox" class="custom-control-input" id="select_all">
//                 <span class="custom-control-label">انتخاب همه</span>
//             </label>
//         </div>
//     </div>
// </div>