<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WareIn extends Model
{
    protected $fillable = ['ware_id', 'amount'];

    public function ware()
    {
        return $this->belongsTo(Ware::class, 'ware_id');
    }
}
