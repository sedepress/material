<?php

namespace App\Http\Requests;

class AdminRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:admins',
            'nickname' => 'required|unique:admins',
            'password' => 'required|between:6,12',
            'repass'   => 'required|same:password',
        ];
    }

    public function attributes()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'nickname' => '昵称',
            'repass'   => '确认密码',
        ];
    }

    public function messages()
    {
        return [
            'repass.same' => '两次密码输入必须一致！'
        ];
    }
}
