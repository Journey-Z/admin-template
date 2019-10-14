<?php
namespace App\Models\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->request->get('id');
        if ($id) {
            return [
                'role_name' => 'required',
                'role_display' => 'required',
                // 'permission_description' => 'required',
                'status' => 'required'
                // 'permissions' => 'required'
            ];
        } else {
            return [
                'role_name' => 'required|unique:pd_roles,name',
                'role_display' => 'required',
                // 'permission_description' => 'required',
                'status' => 'required'
                // 'permissions' => 'required'
            ];
        }
    }

    /**
     * 自定义验证信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'role_name.required' => trans('Auth::auth.role_name_require'),
            'role_name.unique' => trans('Auth::auth.role_unique'),
            'role_display.required' => trans('Auth::auth.role_display_require'),
            'status.required' => trans('Auth::auth.status_require')
        ];
    }
}
