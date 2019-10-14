<?php
namespace App\Modules\Auth\Services;

use App\Modules\Auth\Repositories\UserRepository;
use App\Modules\Auth\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository) {
        $this->roleRepository = $roleRepository;
    }

    public function getList($request)
    {
        $request = $request->all();
        $model = $this->roleRepository->makeModel();
        $searchValue = isset($request['search_value']) ? $request['search_value'] : '';
        if ($searchValue){
            $model = $model->where('name', 'like', "%{$searchValue}%");
        }
        if (isset($request['status']) && $request['status']) {
            $model = $model->where('status', '=', $request['status']);
        }
        return $model->paginate(10);
    }
}