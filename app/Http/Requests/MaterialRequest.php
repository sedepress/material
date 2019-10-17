<?php

namespace App\Http\Requests;

class MaterialRequest extends Request
{
    public function rules()
    {
        switch ($this->method())
        {
            case 'PATCH':
                return [
                    'amount' => 'required|integer',
                    'adjust_status' => 'required|in:inc,dec',
                ];
            default:
                return [
                    'name' => 'required',
                    'image' => 'image',
                    'stock' => 'required|integer',
                ];
        }
    }
}
