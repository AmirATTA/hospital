<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\Builder;

class ActivityLogController extends Controller
{
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view activity-logs')->only('index');

        $this->middleware('permission:create activity-logs')->only('create');

        $this->middleware('permission:edit activity-logs')->only('edit');
    }

    /**
     * Handle the search functionality.
     */
    public function search(Request $request)
    {
        $search = $request->all();

        $activityLogs = Activity::query()
            ->when($search['subject'], fn (Builder $query) => $query->where('subject_type', $search['subject']))
            ->when($search['fromDate'], fn (Builder $query) => $query->where('created_at', '>=', $search['fromDate']))
            ->when($search['toDate'], fn (Builder $query) => $query->where('created_at', '<=', $search['toDate']))
            ->paginate(15)
            ->withQueryString();

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

        return view('admin.activity-log.index')->with([
            'activityLogs' => $activityLogs,
            'subjects' => $subjects,
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
