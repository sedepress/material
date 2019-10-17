<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialsLog extends Model
{
    protected $fillable = [
        'content', 'admin_id'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
