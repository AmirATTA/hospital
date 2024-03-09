<?php

namespace App\Http\Controllers\admin;

use App\Models\Surgery;
use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Traits\RedirectNotify;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class InsuranceReportController extends Controller
{
    use RedirectNotify;
    
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view insurances')->only('index');

        $this->middleware('permission:create insurances')->only('create');
        
        $this->middleware('permission:edit insurances')->only('edit');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.insurance-report.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $search = collect($request->all())->except('_token')->all();

        $insurance = Insurance::query()
            ->when($search['insurances'], fn (Builder $query) => $query->where('id', $search['insurances']))
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

    /**
     * Retrive insurance data's throught form ajax.
     */
    public function getInsuranceNames(Request $request)
    {
        $insurances = Insurance::select('id', 'name')->where('type', $request->data)->orderBy('id', 'desc')->get();

        return response()->json($insurances);
    }
}
