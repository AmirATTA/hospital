<?php

namespace App\Http\Controllers\admin\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PasswordUpdateRequest;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
    
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->with('password-error', 'wrong')
                        ->withErrors($validator)
                        ->withInput();
        }
    
        $user = Auth::user();
    
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('password-error', 'success');
        } else {
            return redirect()->back()->with('password-error', 'wrong')->with('error', 'رمز عبور قبلی شما صحیح نمیباشد');
        }
    }
}
