<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
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
        return view('admin.doctor-report.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $search = collect($request->all())->except('_token')->all();

        $doctor = Doctor::query()
            ->when($search['doctors'], fn (Builder $query) => $query->where('id', $search['doctors']))
            ->first();
        dd($doctor);
        $doctorSurgery = DoctorSurgery::query()
            ->where('doctor_id', $doctor)
            ->first();

        $surgeries = Surgery::query()
            ->select('id', 'patient_name', 'patient_national_code')
            ->when($search['start_date'], fn (Builder $query) => $query->where('released_at', '>=', $search['start_date']))
            ->when($search['end_date'], fn (Builder $query) => $query->where('released_at', '<=', $search['end_date']))
            ->where('basic_insurance_id', $insurance->id)
            ->orWhere('supp_insurance_id', $insurance->id)
            ->with('operations')
            ->paginate(15);

        $totalPrice = 0;
        
        foreach ($surgeries as $surgery) {
            $totalPrice += $surgery->operations->sum('price');
        }

        return view('admin.insurance-report.create')->with([
            'insurance' => $insurance,
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
}
