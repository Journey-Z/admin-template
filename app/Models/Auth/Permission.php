<?php
namespace App\Models\Auth;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    public $timestamp = true;

    const DISABLED_STATUS = 2;
    const ENABLED_STATUS = 1;

    static public $allStatus = [
        self::ENABLED_STATUS => 'enabled',
        self::DISABLED_STATUS => 'disabled'
    ];

    /**
     * 限制查询只包括可用的权限。
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnabled($query)
    {
        return $query->where('status', self::ENABLED_STATUS);
    }
}