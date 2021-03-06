<?php

namespace App\Http\Requests;

class DepartmentRequest extends Request
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
                    'name' => 'required|unique:departments',
                    'parent_id' => 'required',
                    'level' => 'required',
                ];
            case 'PUT':
                return [
                    'name' => 'required|unique:departments',
                ];
            default:
                return [];
        }
    }
}
