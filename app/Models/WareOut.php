<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WareOut extends Model
{
    protected $fillable = ['ware_id', 'amount'];

    public function ware()
    {
        return $this->belongsTo(Ware::class, 'ware_id');
    }

   protected static function booted()
{
    static::created(function ($wareOut) {
        static::updateStock($wareOut->ware_id);
    });

    static::updated(function ($wareOut) {
        $originalWareId = $wareOut->getOriginal('ware_id');
        static::updateStock($originalWareId);
        static::updateStock($wareOut->ware_id);
    });

    static::deleted(function ($wareOut) {
        static::updateStock($wareOut->ware_id);
    });
}

protected static function updateStock($wareId)
{
    $totalIn = \App\Models\WareIn::where('ware_id', $wareId)->sum('amount');
    $totalOut = static::where('ware_id', $wareId)->sum('amount');

    $ware = \App\Models\Ware::find($wareId);
    if ($ware) {
        $ware->stock = $totalIn - $totalOut;
        $ware->save();
    }
}

}
