<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

class AuthController extends Controller
{
    public function login(Request $request) {
        
        $doctor = Doctor::query()->where('mobile', $request->input('mobile'))->first();

        if (!$doctor || !Hash::check($request->input('password'), $doctor->password)) {
            return response()->error('اطلاعات وارد شده اشتباه است', [], 422);
        }
        
        $token = $doctor->createToken('authToken');
        Sanctum::actingAs($doctor);
        
        $data = [
            'doctor' => $doctor,
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer'
        ];
        
        return response()->success('دکتر با موفقیت وارد شد', compact('data'));
    }
    
    public function logout(Request $request) {
        if (Auth::guard('doctor-api')->check()) {
            $doctor = Auth::guard('doctor-api')->user();
            $doctor->currentAccessToken()->delete();
            return response()->success('دکتر با موفقیت از برنامه خارج شد');
        } else {
            return response()->error('کاربر احراز هویت نشده است.', 401);
        }
    }
}
