<?php

namespace App\Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Auth\Permission;
use App\Http\Controllers\Controller;
use App\Modules\Api\Assistants\ApiResponse;
use App\Modules\Auth\Services\PermissionService;
use App\Models\Auth\Requests\StorePermissionRequest;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService) 
    {
        $this->permissionService = $permissionService;
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
        $permissions = $this->permissionService->getList($request);
        $allStatus = Permission::$allStatus;
        return view('Auth::permission.index', compact('permissions', 'allStatus'));
    }

    public function create()
    {
        $allStatus = Permission::$allStatus;
        return view('Auth::permission.add', compact('allStatus'));
    }

    public function edit(Permission $permission)
    {
        $allStatus = Permission::$allStatus;
        return view('Auth::permission.edit', compact('permission', 'allStatus'));
    }

    public function store(StorePermissionRequest $storePermissionRequest)
    {
        if($storePermissionRequest->input('id')) {
            $id = $storePermissionRequest->input('id');
            $permission = Permission::find($id);
            $permission->name = $storePermissionRequest['permission_name'];
            $permission->display_name = $storePermissionRequest['permission_display'];
            $permission->description = $storePermissionRequest['permission_description'];
            $permission->status = $storePermissionRequest['status'];
            $permission->save();
        } else {
            $permission = Permission::create([
                'name' => $storePermissionRequest['permission_name'],
                'display_name' => $storePermissionRequest['permission_display'],
                'description' => $storePermissionRequest['permission_description'],
                'status' => $storePermissionRequest['status']
            ]);
        }
        $message = trans('Dashboard::common.add_failed');
        if ($permission) {
            $message = trans('Dashboard::common.add_success');
            return ApiResponse::success('', $message);
        }
        return ApiResponse::failure(g_API_ERROR, $message);
    }
}
