<?php
namespace App\Models\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
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
                'permission_name' => 'required',
                'permission_display' => 'required',
                // 'permission_description' => 'required',
                'status' => 'required'
                // 'roles' => 'required'
            ];
        } else {
            return [
                'permission_name' => 'required|unique:pd_permissions,name',
                'permission_display' => 'required',
                // 'permission_description' => 'required',
                'status' => 'required'
                // 'roles' => 'required'
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
            'permission_name.required' => trans('Auth::auth.permission_name_require'),
            'permission_name.unique' => trans('Auth::auth.permission_unique'),
            'permission_display.required' => trans('Auth::auth.permission_display_require'),
            'status.required' => trans('Auth::auth.status_require')
        ];
    }
}
