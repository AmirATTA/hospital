<?php

namespace App\Http\Controllers\admin;

use App\Models\Doctor;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DoctorController extends Controller
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
        $doctors = Doctor::orderBy('id', 'desc')->paginate(15);
        return view('admin.doctor.index')->with([
            'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialities = Speciality::get();

        return view('admin.doctor.create')->with([
            'specialities' => $specialities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        $validated = array_merge($request->validated(), [
            'password' => Hash::make($request->input('password')), 
            'speciality_id' => $request->speciality_id,
            'national_code' => $request->national_code,
            'medical_number' => $request->medical_number,
        ]);
        $doctor = Doctor::create($validated);

        if(!$doctor) {
            return redirect(route('doctors.create'))->with('error', 'عملیان انجام نشد');
        } else {
            return redirect(route('doctors.index'))->with('success', 'عملیات با موفقیت انجام شد.');
        }
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
