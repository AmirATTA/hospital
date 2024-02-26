<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Carbon;
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
     * Handle the search functionality.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $search[0] = $search[0] ?? '2000-01-01';
        $search[1] = $search[1] ?? '2099-12-31';
        $search[2] = $search[2] ?? 'App';

        // =============------------------------------=============
        // =============------------------------------=============
        // =============------------------------------=============
        $activityLogs = Activity::query()
            ->whereBetween('created_at', [$search[0], $search[1]])
            ->when($search[2] != null, function ($query) use ($search) {
                return $query->where('subject_type', $search[2]);
            })
            ->paginate(15);
        // =============------------------------------=============
        // =============------------------------------=============
        // =============------------------------------=============

        $subjects = Activity::pluck('subject_type');
        $subjectsArray = $subjects->toArray();
        $subjects = array_unique($subjectsArray);

        return view('admin.activity-log.index')->with([
            'activityLogs' => $activityLogs,
            'search' => $search,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activityLogs = Activity::orderBy('id', 'desc')->paginate(15);

        $subjects = Activity::pluck('subject_type');
        $subjectsArray = $subjects->toArray();
        $subjects = array_unique($subjectsArray);

        $search[2] = '';

        return view('admin.activity-log.index')->with([
            'activityLogs' => $activityLogs,
            'subjects' => $subjects,
            'search' => $search,
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
