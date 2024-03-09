<?php

namespace App\Http\Controllers\admin;

use App\Models\DoctorRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRoleStoreRequest;
use App\Http\Requests\DoctorRoleUpdateRequest;
use App\Traits\RedirectNotify;
use Illuminate\Database\Eloquent\Builder;

class DoctorRoleController extends Controller
{
    use RedirectNotify;

    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view doctor-roles')->only('index');

        $this->middleware('permission:create doctor-roles')->only('create');

        $this->middleware('permission:edit doctor-roles')->only('edit');
    }

    /**
     * Handle the search functionality.
     */
    public function search(Request $request)
    {
        $search = $request->all();

        $doctorRoles = DoctorRole::query()
        ->when($search['title'], fn (Builder $query) => $query->where('title', 'like', '%'.$search['title'].'%'))
            ->paginate(15)
            ->withQueryString();

        return view('admin.doctor-role.index')->with([
            'doctorRoles' => $doctorRoles,
            'search' => $search,
        ]);
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
            return $this->redirectNotify('doctor-roles.create', 'error', 'عملیات به مشکل مواجه شد!');
        } else {
            return $this->redirectNotify('doctor-roles.index', 'success', 'عملیات با موفقیت انجام شد.');
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

        return $this->redirectNotify('doctor-roles.index', 'success', 'بروزرسانی با موفقیت انجام شد.');
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
