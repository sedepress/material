<?php

namespace App\Http\Requests;

class MaterialsReceivingRecordRequest extends Request
{
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'material_id' => 'required|exists:materials,id',
            'amount' => 'required|integer',
        ];
    }
}
