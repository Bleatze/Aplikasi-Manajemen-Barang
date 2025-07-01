<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ware extends Model
{
    protected $fillable = [
        'ware_name', 'category_id', 'unit_id', 'min_stock', 'stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function wareIns()
    {
        return $this->hasMany(WareIn::class, 'ware_id');
    }

    public function wareOuts()
    {
        return $this->hasMany(WareOut::class, 'ware_id');
    }
}
