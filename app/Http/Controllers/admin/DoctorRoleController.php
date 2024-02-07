<?php

namespace App\Http\Controllers\admin;

use App\Models\DoctorRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRoleStoreRequest;
use App\Http\Requests\DoctorRoleUpdateRequest;

class DoctorRoleController extends Controller
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
        $doctorRoles = DoctorRole::orderBy('id', 'desc')->paginate(15);
        return view('admin.doctor-role.index')->with([
            'doctorRoles' => $doctorRoles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctor-role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRoleStoreRequest $request)
    {
        $doctorRole = DoctorRole::create($request->validated());

        if(!$doctorRole) {
            return redirect(route('doctor-roles.create'))->with('error', 'عملیان انجام نشد');
        } else {
            return redirect(route('doctor-roles.index'))->with('success', 'عملیات با موفقیت انجام شد.!');
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
    public function edit(DoctorRole $doctorRole)
    {
        return view('admin.doctor-role.edit')->with([
            'doctorRole' => $doctorRole,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRoleUpdateRequest $request, string $id)
    {
        $doctorRole = DoctorRole::findOrFail($id);

        $doctorRole->update($request->validated());

        return redirect()->route('doctor-roles.index')->with('success', 'عملیات با موفقیت انجام شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctorRole = DoctorRole::findOrFail($id);
        $doctorRole->delete();
    }
}
