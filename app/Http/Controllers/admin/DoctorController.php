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

        $doctorPermissions = Role::where('name', 'Doctor')->first();
        $permissions = $doctorPermissions->permissions->pluck('label', 'id');

        return view('admin.doctor.create')->with([
            'permissions' => $permissions,
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
            'speciality_id' => $request->speciality_id
        ]);
        $doctor = Doctor::create($validated);

        if(!empty($request->permissions)) {
            $permissions = Permission::whereIn('id', $request->permissions)->get()->pluck('name');
            foreach ($permissions as $permission) {
                $user->givePermissionTo($permission);
            }
        }

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
