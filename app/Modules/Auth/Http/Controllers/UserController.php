<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Models\Auth\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Auth\Services\UserService;
use App\Modules\Api\Assistants\ApiResponse;
use App\Models\Auth\Requests\StoreUsersRequest;
use App\Models\Auth\Role;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 用户列表页面
     *
     * @param void
     * @return mixed
     */
    public function index(Request $request)
    {
        $request->flash();
        $users = $this->userService->getList($request);
        $allStatus = User::$allStatus;
        return view('Auth::user.index', compact('users', 'allStatus'));
    }

    public function create()
    {
        $allStatus = User::$allStatus;
        $roles = Role::enabled()->get();
        return view('Auth::user.add', compact('allStatus', 'roles'));
    }

    public function edit(User $user)
    {
        $allStatus = User::$allStatus;
        $roles = Role::enabled()->get();
        return view('Auth::user.edit', compact('user', 'roles', 'allStatus'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request)
    {
        $isCreate = $request->input('id') ? false : true;
        if (!$isCreate) {
            $id = $request->input('id');
            $user = User::find($id);
            $user->email = $request['email'];
            $user->name = $request['name'];
            $user->status = $request['status'];
            $user->save();
        } else {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password'])
            ]);
        }
        $message = trans('Dashboard::common.add_failed');
        if ($user) {
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $isCreate ? $user->assignRole($roles) : $user->syncRoles($roles);
            $message = trans('Dashboard::common.add_success');
            return ApiResponse::success('', $message);
        }
        return ApiResponse::failure(g_API_ERROR, $message);
    }
}
