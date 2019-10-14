<?php
namespace App\Modules\Auth\Services;

use App\Modules\Auth\Repositories\PermissionRepository;

class PermissionService
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository) {
        $this->permissionRepository = $permissionRepository;
    }

    public function getList($request)
    {
        $request = $request->all();
        $model = $this->permissionRepository->makeModel();
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