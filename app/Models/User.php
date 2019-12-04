<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name', 'department_id', 'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function materialsRecords()
    {
        return $this->hasMany(MaterialsReceivingRecord::class);
    }

    public function lastPickUpTime()
    {
        return $this->hasMany(MaterialsReceivingRecord::class)->orderBy('created_at')->limit(1);
    }
}
