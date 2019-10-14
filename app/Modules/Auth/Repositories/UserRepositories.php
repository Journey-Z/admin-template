<?php
namespace App\Modules\Auth\Repositories;

use App\Models\Auth\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }
}