<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Surgery;
use App\Models\DoctorRole;
use Illuminate\Http\Request;
use App\Traits\RedirectNotify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;

class DoctorSurgeryController extends Controller
{
    use RedirectNotify;
    
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view doctor-surgeries')->only('index');

        $this->middleware('permission:create doctor-surgeries')->only('create');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all();

        return view('admin.doctor-surgery.index')->with([
            'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $search = collect($request->all())->except('_token')->all();
        $doctorId = $search['doctor'];

        $startDate = $search['start_date'] == null ? Carbon::now()->toDateString() : $search['start_date'];

        $surgeries = Surgery::whereHas('doctors', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        })->whereBetween('created_at', [$startDate, $search['end_date']])->get();

        return view('admin.doctor-surgery.create')->with([
            'surgeries' => $surgeries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
