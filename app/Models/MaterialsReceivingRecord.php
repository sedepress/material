<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialsReceivingRecord extends Model
{
    protected $fillable = [
        'material_id', 'user_id', 'amount'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
