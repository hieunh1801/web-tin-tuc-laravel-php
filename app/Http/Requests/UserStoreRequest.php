<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Xác thực người dùng có quyền sử dụng tài nguyên không
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Thêm rule vào các input
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:24|unique:users,name',    
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            're-password' => 'required|same:password'
        ];
    }

    /**
     * Thông báo lỗi
     *
     * @return array
     */
    public function messages() 
    {
        return [
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tối thiểu 3 kí tự, tối đa 24 kí tự',
            'name.max' => 'Tối thiểu 3 kí tự, tối đa 24 kí tự',
            'name.unique' => 'Tên bị trùng',

            'email.required' => 'Vui lòng nhập địa chỉ email',
            'email.email' => 'Chưa nhập đúng định dạng email',
            'email.unique' => 'Email bị trùng',
            
            'password.required' => 'Chưa nhập password',
            're-password.required' => 'Chưa nhập lại password',
            're-password.same' => 'Chưa nhập đúng lại password',
        ];
    }
}
