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

    protected static function booted()
{
    static::created(function ($wareIn) {
        static::updateStock($wareIn->ware_id);
    });

    static::updated(function ($wareIn) {
        $originalWareId = $wareIn->getOriginal('ware_id');
        static::updateStock($originalWareId);
        static::updateStock($wareIn->ware_id);
    });

    static::deleted(function ($wareIn) {
        static::updateStock($wareIn->ware_id);
    });
}

protected static function updateStock($wareId)
{
    $totalIn = static::where('ware_id', $wareId)->sum('amount');
    $totalOut = \App\Models\WareOut::where('ware_id', $wareId)->sum('amount');

    $ware = \App\Models\Ware::find($wareId);
    if ($ware) {
        $ware->stock = $totalIn - $totalOut;
        $ware->save();
    }
}
}
