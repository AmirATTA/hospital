<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view doctors')->only('index');

        $this->middleware('permission:create doctors')->only('create');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activityLog = Activity::orderBy('id', 'desc')->paginate(15);
        return view('admin.activity-log.index')->with([
            'activityLog' => $activityLog,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activityLog = Activity::findOrFail($id);
        
        $userAttributes = json_decode($activityLog->properties, true);

        $causer = User::where('id', $activityLog->causer_id)->first();

        return view('admin.activity-log.show')->with([
            'activityLog' => $activityLog,
            'userAttributes' => $userAttributes,

            'causer' => $causer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id == 'all') {
            Activity::truncate();
            return response()->json('all');
        }
        $activityLog = Activity::findOrFail($id);
        $activityLog->delete();
    }
}
