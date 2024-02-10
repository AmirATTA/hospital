<?php

namespace App\Http\Controllers\admin;

use App\Models\Doctor;
use App\Models\DoctorRole;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;

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
        $doctorRoles = DoctorRole::where('status', '1')->get();

        return view('admin.doctor.create')->with([
            'specialities' => $specialities,
            'doctorRoles' => $doctorRoles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorStoreRequest $request)
    {
        $doctorRoles = $request->input('doctorRoles');

        $validated = array_merge($request->validated(), [
            'password' => Hash::make($request->input('password')), 
            'speciality_id' => $request->speciality_id,
            'national_code' => $request->national_code,
            'medical_number' => $request->medical_number,
        ]);
        $doctor = Doctor::create($validated);
        $doctor->attachRoles($doctorRoles);

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
        $doctor = Doctor::findOrFail($id);

        $speciality = Speciality::findOrFail($doctor->speciality_id);

        $doctorRoles = $doctor->doctorRoles;

        return view('admin.doctor.show')->with([
            'doctor' => $doctor,
            'doctorRoles' => $doctorRoles,
            'speciality' => $speciality,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $specialities = Speciality::get();
        $doctorRoles = DoctorRole::where('status', '1')->get();
        $doctorRoleIds = $doctor->doctorRoles()->pluck('doctor_roles.id')->toArray();

        return view('admin.doctor.edit')->with([
            'specialities' => $specialities,
            'doctorRoles' => $doctorRoles,
            'doctorRoleIds' => $doctorRoleIds,
            'doctor' => $doctor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorUpdateRequest $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);

        $doctorRoles = $request->input('doctorRoles');

        $validated = array_merge($request->validated(), [
            'password' => Hash::make($request->input('password')), 
        ]);

        $doctor->update($validated);

        $doctor->attachRoles($doctorRoles);

        if(!$doctor) {
            return redirect(route('doctors.create'))->with('error', 'عملیان انجام نشد');
        } else {
            return redirect(route('doctors.index'))->with('success', 'عملیات با موفقیت انجام شد.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
    }
}
