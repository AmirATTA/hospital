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
        //
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
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);

        $doctorRoles = $request->input('doctorRoles');

        $validatedData = $request->except('password');

        if ($request->filled('password')) {
            $validatedData = $request->validate([
                'name' => 'required|unique:doctors,name',
                'speciality_id' => 'required',
                'mobile' => [
                    'required',
                    Rule::unique('doctors')->ignore($doctor->id),
                ],
                'doctorRoles' => 'required',
                'password' => 'nullable|confirmed',
            ]);
        } else {
            $validatedData = $request->validate([
                'name' => 'required|unique:doctors,name',
                'speciality_id' => 'required',
                'mobile' => [
                    'required',
                    Rule::unique('doctors')->ignore($doctor->id),
                ],
                'doctorRoles' => 'required',
            ]);
        }

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->input('password'));
        }


        $doctor->update($validatedData);

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
        //
    }
}
