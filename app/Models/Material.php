<?php

namespace App\Models;

use App\Exceptions\InternalException;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name', 'image', 'receive_count', 'stock', 'recent_deposit_time', 'create_user', 'status'
    ];

    protected $casts = [
        'recent_deposit_time' => 'datetime',
        'status' => 'boolean',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'create_user');
    }

    public function materialsRecords()
    {
        return $this->hasMany(MaterialsReceivingRecord::class);
    }

    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('减库存不可小于0');
        }

        $this->where('id', $this->id)->increment('receive_count', $amount);

        return $this->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    public function incrementStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('加库存不可小于0');
        }

        $this->where('id', $this->id)->increment('stock', $amount);

        return $this->where('id', $this->id)->where('receive_count', '>=', $amount)->decrement('receive_count', $amount);
    }
}
