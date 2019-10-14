<?php

return [
    'menus' => [
        [
            'roles'=>'*',
            'is_open'=>false,
            'icon'=>'fa fa-wrench',
            'title'=>'Users Management',
            'permission' => ['LIST_ADMIN', 'LIST_ROLE', 'LIST_PERMISSION'],
            'menus'=>[
                [
                    'icon'=>'fa fa-user',
                    'title'=>'Users Management',
                    'link'=>'/auth/user',
                    'roles'=>'admin',
                    'permission' => 'LIST_ADMIN',
                    'is_active'=>false,
                ],
                [
                    'icon'=>'fa fa-users',
                    'title'=>'Roles Management',
                    'link'=>'/auth/role',
                    'roles'=>'admin',
                    'permission' => 'LIST_ROLE',
                    'is_active'=>false,
                ],
                [
                    'icon'=>'fa fa-lock',
                    'title'=>'Permissions Management',
                    'link'=>'/auth/permission',
                    'roles'=>'admin',
                    'permission' => 'LIST_PERMISSION',
                    'is_active'=>false,
                ],
            ]
        ],
        [
            'roles' => '*',
            'is_open' => false,
            'icon' => 'fa fa-cogs',
            'title' => 'System Management',
            'site' => '*',
            'menus' => [
                [
                    'icon' => 'fa fa-list-alt',
                    'title' => 'System Logs',
                    'site' => '*',
                    'link' => '/log/sys',
                    'roles' => '*',
                    'is_active' => false,
                ],
                [
                    'icon' => 'fa fa-warning',
                    'title' => 'Error Logs',
                    'site' => '*',
                    'link' => '/log/error',
                    'roles' => 'admin',
                    'is_active' => false,
                ]
            ]
        ],
    ]
];