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
        switch ($this->method())
        {
            case 'POST':
                return [
                    'username' => 'required|unique:admins',
                    'nickname' => 'required|unique:admins',
                    'password' => 'required|between:6,12',
                    'repass'   => 'required|same:password',
                ];
            case 'PUT':
                return [
                    'username' => 'required|unique:admins,username,' . $this->route('admin')->id,
                    'nickname' => 'required|unique:admins,nickname,' . $this->route('admin')->id,
                ];
            default:
                return [];
        }
    }

    public function attributes()
    {
        return [
            'username' => '登录名',
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
