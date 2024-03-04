<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Traits\RedirectNotify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    use RedirectNotify;

    public function index()
    {
        $activityLogs = Activity::select('id', 'description', 'subject_type', 'causer_id')->take(5)->get();

        return view('admin.dashboard')->with([
            'activityLogs' => $activityLogs,
        ]);
    }
}
