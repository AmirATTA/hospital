<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function test()
    {
        // auth()->user()->givePermissionTo('view user');
        // dd(auth()->user()->getAllPermissions());
    }
}
