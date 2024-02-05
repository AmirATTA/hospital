<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view users')->only('index');

        $this->middleware('permission:create users')->only('create');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $superAdmin = User::role('Super Admin')->first();
        $users = User::orderBy('id', 'desc')->whereNotIn('id', [$superAdmin->id])->paginate(15);
        return view('admin.user.index')->with([
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $adminPermissions = Role::where('name', 'Admin')->first();
        $permissions = $adminPermissions->permissions->pluck('label', 'id');

        return view('admin.user.create')->with([
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $validated = array_merge($request->validated(), ['password' => Hash::make($request->input('password'))]);
        $user = User::create($validated);

        if(!empty($request->permissions)) {
            $permissions = Permission::whereIn('id', $request->permissions)->get()->pluck('name');
            foreach ($permissions as $permission) {
                $user->givePermissionTo($permission);
            }
        }

        if(!$user) {
            return redirect(route('users.create'))->with('error', 'عملیان انجام نشد');
        } else {
            return redirect(route('users.index'))->with('success', 'عملیات با موفقیت انجام شد.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $adminPermissions = Role::where('name', 'Admin')->first();
        $permissions = $adminPermissions->permissions->pluck('label', 'id');
        
        $userPermissions = $user->getDirectPermissions();
        $permissionId = [];
        foreach ($userPermissions as $userData) {
            $permissionId[] = $userData['id'];
        }
        
        return view('admin.user.edit')->with([
            'user' => $user,
            'permissions' => $permissions,
            'userPermissions' => $permissionId,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->except('password');

        if(!empty($request->permissions)) {
            $permissions = array_map('intval', $validatedData['permissions']);
        }

        if ($request->filled('password')) {
            $validatedData = $request->validate([
                'name' => 'required',
                'mobile' => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
                'password' => 'nullable|confirmed',
                'email' => 'nullable',
            ]);
        } else {
            $validatedData = $request->validate([
                'name' => 'required',
                'mobile' => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
                'email' => 'nullable',
            ]);
        }

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->input('password'));
        }

        $user->update($validatedData);
        if(!empty($request->permissions)) {
            $user->syncPermissions($permissions);
        } else {
            $user->syncPermissions([]);
        }

        return redirect()->route('users.index')->with('success', 'خبر با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->syncPermissions([]);
        $user->delete();
    }
}
