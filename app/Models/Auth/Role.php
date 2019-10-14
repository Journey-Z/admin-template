<?php
namespace App\Models\Auth;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public $timestamp = true;

    const DISABLED_STATUS = 2;
    const ENABLED_STATUS = 1;

    static public $allStatus = [
        self::ENABLED_STATUS => 'enabled',
        self::DISABLED_STATUS => 'disabled'
    ];

    /**
     * 限制查询只包括可用的角色。
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnabled($query)
    {
        return $query->where('status', self::ENABLED_STATUS);
    }
}