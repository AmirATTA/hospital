<?php

namespace App\Http\Controllers\admin;

use App\Models\Doctor;
use App\Mail\DoctorEmail;
use App\Models\DoctorRole;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Traits\RedirectNotify;
use Illuminate\Database\Eloquent\Builder;

class DoctorController extends Controller
{
    use RedirectNotify;

    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view doctors')->only('index');

        $this->middleware('permission:create doctors')->only('create');

        $this->middleware('permission:edit doctors')->only('edit');
    }

    /**
     * Handle the search functionality.
     */
    public function search(Request $request)
    {
        $search = $request->all();

        $doctors = Doctor::query()
            ->when($search['name'], fn (Builder $query) => $query->where('name', 'like', '%'.$search['name'].'%'))
            ->paginate(15)
            ->withQueryString();

        return view('admin.doctor.index')->with([
            'doctors' => $doctors,
            'search' => $search,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
        
        if(!empty($request->email)) {
            Mail::to($request->email)->send(new DoctorEmail($request->name, $request->mobile, $request->password));
        }

        if(!$doctor) {
            return $this->redirectNotify('doctors.create', 'error', 'عملیات به مشکل مواجه شد!');
        } else {
            return $this->redirectNotify('doctors.index', 'success', 'عملیات با موفقیت انجام شد.');
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

        $doctor->attachRoles($doctorRoles, true);

        if(!$doctor) {
            return $this->redirectNotify('doctors.create', 'error', 'بروزرسانی به مشکل مواجه شد!');
        } else {
            return $this->redirectNotify('doctors.index', 'success', 'بروزرسانی با موفقیت انجام شد.');
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
