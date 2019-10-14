<?php
namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;


class MenuComposer
{
    public function compose(View $view)
    {
        if ($view->name() == 'Dashboard::layouts.menu') {
            $this->configureLeftSideMenu($view);
        }
    }

    /**
     * 配置左边菜单
     *
     * @param $view
     */
    private function configureLeftSideMenu($view)
    {

        $menus = config('menu')['menus'];
        $url_path = Request::path();
        $is_open = false;
        $new_menus = [];
        $user = \Auth::user();
        //$role_names = $user->role_names();
        foreach ($menus as $menu) {
            //获取用户设置的可访问角色
            // $_role_names = explode(',',$menu['roles']);
            // if(!$this->isAuth($_role_names,$role_names)){
            //     continue;
            // }
            if ($menu['roles'])
                $menu['is_open'] = false;
            $new_sub_menus = [];
            foreach ($menu['menus'] as $sub_menu) {
                if (isset($sub_menu['roles'])) {
                    // $_role_names = explode(',',$sub_menu['roles']);
                    // if(!$this->isAuth($_role_names,$role_names)){
                    //     continue;
                    // }
                }
                $sub_menu['is_active'] = false;
                $path_info = parse_url($sub_menu['link']);
                if ((parse_url('/' . $url_path)['path'] == $path_info['path']) && !$is_open) {
                    $is_open = true;
                    $menu['is_open'] = true;
                    $sub_menu['is_active'] = true;
                }
                $new_sub_menus[] = $sub_menu;
            }
            $menu['menus'] = $new_sub_menus;
            $new_menus[] = $menu;
        }
        $view->with(['menus' => $new_menus]);
    }

    function isAuth($configure_rolenames, $user_rolenames)
    {
        //如果用户是管理员那么所有的连接对他都是开放的
        if (in_array('admin', $user_rolenames)) {
            return true;
        }
        //判断用户页面的权限
        $is_auth = false;
        //获取用户设置的可访问角色
        if (in_array('*', $configure_rolenames)) {
            $is_auth = true;
        } else {
            foreach ($user_rolenames as $role_name) {
                if (in_array($role_name, $configure_rolenames)) {
                    $is_auth = true;
                    break;
                }
            }
        }
        return $is_auth;
    }
}