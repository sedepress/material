<?php

namespace App\Http\Requests;

class UserRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required',
            'department_id' => 'required|exists:departments,id'
        ];
    }
}
