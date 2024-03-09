<?php

namespace App\Http\Controllers\admin;

use App\Models\Doctor;
use App\Models\Surgery;
use Illuminate\Http\Request;
use App\Models\DoctorSurgery;
use App\Traits\RedirectNotify;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;


class DoctorReportController extends Controller
{
    use RedirectNotify;
    
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
        $doctors = Doctor::select('id', 'name')->get();

        return view('admin.doctor-report.index')->with([
            'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $search = collect($request->all())->except('_token')->all();

        $doctor = Doctor::query()
            ->select('id', 'name')
            ->when($search['doctor'], fn (Builder $query) => $query->where('id', $search['doctor']))
            ->first();

        $doctorSurgery = DoctorSurgery::query()
            ->select('surgery_id')
            ->where('doctor_id', $doctor->id)
            ->paginate(15);

        $surgeries = [];

        foreach($doctorSurgery as $surgeryId) {
            $surgeries[] = Surgery::query()
                ->select('id', 'patient_name', 'basic_insurance_id', 'supp_insurance_id', 'surgeried_at', 'description')
                ->where('id', $surgeryId->surgery_id)
                ->when($search['start_date'], fn (Builder $query) => $query->where('released_at', '>=', $search['start_date']))
                ->when($search['end_date'], fn (Builder $query) => $query->where('released_at', '<=', $search['end_date']))
                ->with('operations')
                ->get()[0];
        }

        $totalPrice = 0;
        
        foreach ($surgeries as $surgery) {
            $totalPrice += $surgery->operations->sum('price');
        }

        return view('admin.doctor-report.create')->with([
            'doctor' => $doctor,
            'doctorSurgery' => $doctorSurgery,
            'surgeries' => $surgeries,
            'totalPrice' => $totalPrice,
        ]);
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

    /**
     * Retrive description data.
     */
    public function description(string $id)
    {
        $surgery = Surgery::select('description')->findOrFail($id);
        return response()->json($surgery->description);
    }
}
