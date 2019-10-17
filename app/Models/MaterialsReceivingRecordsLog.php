<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialsReceivingRecordsLog extends Model
{
    protected $fillable = [
        'user_id', 'material_id', 'amount', 'create_user',
    ];
}
