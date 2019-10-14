<?php
namespace App\Models\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersRequest extends FormRequest
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
        if($id) {
            return [
                'name' => 'required',
                'email' => 'required|email',
                'status' => 'required'
                // 'roles' => 'required'
            ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:pd_users,email',
                'password' => 'required',
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
            'name.required' => trans('Auth::auth.name_require'),
            'email.required' => trans('Auth::auth.email_require'),
            'email.email' => trans('Auth::auth.email_format'),
            'email.unique' => trans('Auth::auth.email_unique'),
            'password.required' => trans('Auth::auth.password_require'),
            'status.required' => trans('Auth::auth.status_require'),
        ];
    }
}
