<?php

namespace App\Http\Controllers\admin\auth;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function loginPost(LoginRequest $request)
    {
        $credentials = $request->only('mobile', 'password');
        if (Auth::attempt($credentials)) {
            return redirect(route('dashboard.index'))->with('success', 'با موفقیت انجام شد.');
        } else {
            return redirect(route('login'))->with('error', 'شماره موبايل یا گذرواژه نادرست است!');
        }
    }
}
