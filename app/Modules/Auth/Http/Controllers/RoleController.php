<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Models\Auth\Role;
use Illuminate\Http\Request;

use App\Models\Auth\Permission;
use App\Http\Controllers\Controller;
use App\Modules\Auth\Services\RoleService;
use App\Modules\Api\Assistants\ApiResponse;
use App\Models\Auth\Requests\StoreRoleRequest;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService) 
    {
        $this->roleService = $roleService;
    }

    //
        /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(401);
        // }

        $request->flash();
        $roles = $this->roleService->getList($request);
        $allStatus = Role::$allStatus;
        return view('Auth::role.index', compact('roles', 'allStatus'));
    }

    public function create()
    {
        $allStatus = Role::$allStatus;
        $permissions = Permission::enabled()->get();
        return view('Auth::role.add', compact('permissions', 'allStatus'));
    }

    public function edit(Role $role)
    {
        $allStatus = Role::$allStatus;
        $permissions = Permission::enabled()->get();
        return view('Auth::role.edit', compact('role', 'permissions', 'allStatus'));
    }

    public function store(StoreRoleRequest $storeRoleRequest)
    {
        $isCreate = $storeRoleRequest->input('id') ? false : true;
        if(!$isCreate) {
            $id = $storeRoleRequest->input('id');
            $role = Role::find($id);
            $role->name = $storeRoleRequest['role_name'];
            $role->display_name = $storeRoleRequest['role_display'];
            $role->description = $storeRoleRequest['role_description'];
            $role->status = $storeRoleRequest['status'];
            $role->save();
        } else {
            $role = Role::create([
                'name' => $storeRoleRequest['role_name'],
                'display_name' => $storeRoleRequest['role_display'],
                'description' => $storeRoleRequest['role_description'],
                'status' => $storeRoleRequest['status']
            ]);
        }
        $message = trans('Dashboard::common.add_failed');
        if ($role) {
            $permissions = $storeRoleRequest->input('permissions') ? $storeRoleRequest->input('permissions') : [];
            $isCreate ? $role->givePermissionTo($permissions) : $role->syncPermissions($permissions);;
            $message = trans('Dashboard::common.add_success');
            return ApiResponse::success('', $message);
        }
        return ApiResponse::failure(g_API_ERROR, $message);
    }
}
