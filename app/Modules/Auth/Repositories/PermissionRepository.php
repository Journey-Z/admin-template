<?php
namespace App\Modules\Auth\Repositories;

use App\Models\Auth\Permission;
use Prettus\Repository\Eloquent\BaseRepository;

class PermissionRepository extends BaseRepository
{
    public function model()
    {
        return Permission::class;
    }
}