<?php

namespace App\Http\Controllers\admin;

use App\Models\Surgery;
use App\Models\Insurance;
use App\Models\Operation;
use App\Models\DoctorRole;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SurgeryStoreRequest;
use App\Http\Requests\SurgeryUpdateRequest;

class SurgeryController extends Controller
{
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view surgeries')->only('index');

        $this->middleware('permission:create surgeries')->only('create');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surgeries = Surgery::orderBy('id', 'desc')->paginate(15);
        return view('admin.surgery.index')->with([
            'surgeries' => $surgeries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctorRoles = DoctorRole::orderBy('title', 'desc')->with('doctors')->get();
        $insurances = Insurance::orderBy('type', 'desc')->get();
        $operations = Operation::where('status', '1')->get();

        return view('admin.surgery.create')->with([
            'insurances' => $insurances,
            'operations' => $operations,
            'doctorRoles' => $doctorRoles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SurgeryStoreRequest $request)
    {
        $operations = $request->input('operations');
        $doctorsInputRequired = $request->input('doctorsInputRequired');
        $doctorsInputNotRequired = $request->input('doctorsInput');
        $doctorsInput = array_merge($doctorsInputRequired, $doctorsInputNotRequired);

        if($request->insurance != null) {
            $insurance = Insurance::where('id', $request->insurance)->first();

            if($insurance->type == 'basic') {
                $validated = array_merge($request->validated(), [
                    'basic_insurance_id' => $insurance->id, 
                ]);
            } else if($insurance->type == 'supplementary') {
                $validated = array_merge($request->validated(), [
                    'supp_insurance_id' => $insurance->id, 
                ]);
            }

            Arr::forget($validated, 'insurance');
        } else {
            $validated = array_merge($request->validated());
        }


        $surgery = surgery::create($validated);
        $surgery->attachOperations($operations);
        $surgery->attachDoctors($doctorsInput);

        if(!$surgery) {
            return redirect(route('surgeries.create'))->with('error', 'عملیان انجام نشد');
        } else {
            return redirect(route('surgeries.index'))->with('success', 'عملیات با موفقیت انجام شد.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $surgery = Surgery::findOrFail($id);

        $operations = $surgery->operations()->select('name', 'price')->get()->toArray();

        $insuranceId = $surgery->basic_insurance_id != null ? $surgery->basic_insurance_id : $surgery->supp_insurance_id;
        if($insuranceId != null) {
            $insurance = Insurance::findOrFail($insuranceId);
            $discountedPrice = $operations[0]['price'] - ($operations[0]['price'] * ($insurance->discount / 100));
            $insuranceType = $insurance->type == 'supplementary' ? 'تکمیلی' : 'پایه';
        } else {
            $insurance = null;
            $discountedPrice = null;
            $insuranceType = null   ;
        }

        $doctors = $surgery->doctors;

        return view('admin.surgery.show')->with([
            'surgery' => $surgery,

            'operations' => $operations,
            
            'insurance' => $insurance,
            'discountedPrice' => $discountedPrice,
            'insuranceType' => $insuranceType,

            'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $surgery = Surgery::findOrFail($id);

        $doctorRoles = DoctorRole::orderBy('title', 'desc')->with('doctors')->get();
        $insurances = Insurance::orderBy('type', 'desc')->get();
        $operations = Operation::where('status', '1')->get();

        $insurance = $surgery->basic_insurance_id != null ? $surgery->basic_insurance_id : $surgery->supp_insurance_id;

        $operationIds = $surgery->operations()->pluck('operations.id')->toArray();

        $doctors = $surgery->doctors()->pluck('doctors.id')->toArray();

        return view('admin.surgery.edit')->with([
            'surgery' => $surgery,

            'insurance' => $insurance,
            'operations' => $operations,
            'doctorRoles' => $doctorRoles,

            'insurances' => $insurances,

            'operationIds' => $operationIds,

            'doctors' => $doctors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SurgeryUpdateRequest $request, string $id)
    {
        $surgery = Surgery::findOrFail($id);

        $operations = $request->input('operations');
        $doctorsInputRequired = $request->input('doctorsInputRequired');
        $doctorsInputNotRequired = $request->input('doctorsInput');
        $doctorsInput = array_merge($doctorsInputRequired, $doctorsInputNotRequired);

        if($request->insurance != null) {
            $insurance = Insurance::where('id', $request->insurance)->first();

            if($insurance->type == 'basic') {
                $validated = array_merge($request->validated(), [
                    'basic_insurance_id' => $insurance->id, 
                ]);
            } else if($insurance->type == 'supplementary') {
                $validated = array_merge($request->validated(), [
                    'supp_insurance_id' => $insurance->id, 
                ]);
            }

            Arr::forget($validated, 'insurance');
        } else {
            $validated = array_merge($request->validated());
        }


        $surgery->update($validated);
        $surgery->attachOperations($operations, true);
        $surgery->attachDoctors($doctorsInput, true);
        

        return redirect()->route('surgeries.index')->with('success', 'خبر با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $surgery = Surgery::findOrFail($id);
        $surgery->delete();
    }
}
