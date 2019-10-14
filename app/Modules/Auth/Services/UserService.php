<?php
namespace App\Modules\Auth\Services;

use App\Modules\Auth\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getList($request)
    {
        $request = $request->all();
        $model = $this->userRepository->makeModel();
        $searchType = isset($request['search_type']) ? $request['search_type'] : '';
        $searchValue = isset($request['search_value']) ? $request['search_value'] : '';
        switch ($searchType){
            case 'name':
                $model = $model->where('name', 'like', "%{$searchValue}%");
                break;
            case 'email':
                $model = $model->where('email', 'like', "%{$searchValue}%");
                break;
        }
        if (isset($request['status']) && $request['status']) {
            $model = $model->where('status', '=', $request['status']);
        }
        return $model->paginate(10);
    }
}