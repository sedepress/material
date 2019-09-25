<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'code', 'parent_id', 'level', 'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function children()
    {
        return $this->hasMany(Department::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Department::class);
    }
}
