<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function test()
    {
        auth()->user()->givePermissionTo('view specialities');
        // auth()->user()->revokePermissionTo('create user');
    }
}
