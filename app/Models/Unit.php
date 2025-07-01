<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['unit_name'];

    public function wares()
    {
        return $this->hasMany(Ware::class, 'unit_id');
    }
}
