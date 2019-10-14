<?php
namespace App\Modules\Auth\Repositories;

use App\Models\Auth\Role;
use Prettus\Repository\Eloquent\BaseRepository;

class RoleRepository extends BaseRepository
{
    public function model()
    {
        return Role::class;
    }
}