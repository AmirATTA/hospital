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
use App\Traits\RedirectNotify;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    use RedirectNotify;
    
    /**
     * MiddleWares.
     */
    public function __construct()
    {
        $this->middleware('permission:view users')->only('index');

        $this->middleware('permission:create users')->only('create');
    }

    /**
     * Handle the search functionality.
     */
    public function search(Request $request)
    {
        $search = $request->all();

        $superAdmin = User::role('Super Admin')->first();
        $users = User::query()
            ->when($search['name'], fn (Builder $query) => $query->where('name', 'like', '%'.$search['name'].'%'))
            ->when($search['mobile'], fn (Builder $query) => $query->where('mobile', 'like', '%'.$search['mobile'].'%'))
            ->whereNotIn('id', [$superAdmin->id])
            ->paginate(15)
            ->withQueryString();

        return view('admin.user.index')->with([
            'users' => $users,
            'search' => $search,
        ]);
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
        $permissions = $adminPermissions->permissions->pluck('id');

        $originalArray = $permissions->toArray();
        $chunkedArray = array_chunk($originalArray, 4, true);

        return view('admin.user.create')->with([
            'admin' => $adminPermissions,
            'permissions' => $chunkedArray,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        dd($request->all());
        $permission_ids = explode(',', $request->permission_ids);
        $ids = array_filter($permission_ids, function($value) {
            return $value !== '';
        });
        
        $validated = array_merge($request->validated(), ['password' => Hash::make($request->input('password'))]);
        $user = User::create($validated);

        if(!empty($permission_ids)) {
            $permNamesArray = [];
            foreach($ids as $permId) {
                $permName = Permission::where('id', $permId)->get()->pluck('name');
                $permNamesArray[] = $permName;
            }
            foreach ($permNamesArray as $permission) {
                $user->givePermissionTo($permission);
            }
        }

        if(!$user) {
            return $this->redirectNotify('users.create', 'error', 'عملیات به مشکل مواجه شد!');
        } else {
            return $this->redirectNotify('users.index', 'success', 'عملیات با موفقیت انجام شد.');
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
        $permissions = $adminPermissions->permissions->pluck('id');

        $originalArray = $permissions->toArray();
        $chunkedArray = array_chunk($originalArray, 4, true);

        $userPermissions = $user->getDirectPermissions();
        $permissionId = [];
        foreach ($userPermissions as $userData) {
            $permissionId[] = $userData['id'];
        }
        
        return view('admin.user.edit')->with([
            'user' => $user,
            'permissions' => $chunkedArray,
            'userPermissions' => $permissionId,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $permission_ids = explode(',', $request->permission_ids);
        $ids = array_filter($permission_ids, function($value) {
            return $value !== '';
        });
        
        $validated = array_merge($request->validated(), [
            'password' => Hash::make($request->input('password')), 
        ]);

        $user->update($validated);

        if(!empty($ids)) {
            $permNamesArray = [];
            foreach($ids as $permId) {
                $permName = Permission::where('id', $permId)->get()->pluck('name');
                $permNamesArray[] = $permName;
            }
            $user->syncPermissions($permNamesArray);
        } else {
            $userPermission = $user->getDirectPermissions();
            if($userPermission != null) {
                foreach($userPermission as $permission) {
                    $user->revokePermissionTo($permission['name']);
                }
            } else {
                $user->revokePermissionTo($userPermission[0]['name']);
            }
        }

        return $this->redirectNotify('users.index', 'success', 'بروزرسانی با موفیقت انجام شد.');
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
