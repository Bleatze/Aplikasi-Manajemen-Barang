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
        // Tambah: stok bertambah
        static::created(function ($wareIn) {
            if ($wareIn->ware) {
                $wareIn->ware->increment('stock', $wareIn->amount);
            }
        });

        // Edit: jika ware_id berubah, stok lama dikurangi, stok baru ditambah
        static::updated(function ($wareIn) {
            $originalWareId = $wareIn->getOriginal('ware_id');
            $originalAmount = $wareIn->getOriginal('amount');

            if ($originalWareId != $wareIn->ware_id) {
                $oldWare = Ware::find($originalWareId);
                if ($oldWare) {
                    $oldWare->decrement('stock', $originalAmount);
                }

                if ($wareIn->ware) {
                    $wareIn->ware->increment('stock', $wareIn->amount);
                }
            } else {
                $selisih = $wareIn->amount - $originalAmount;
                if ($wareIn->ware && $selisih !== 0) {
                    $wareIn->ware->increment('stock', $selisih);
                }
            }
        });

        // Hapus: stok dikurangi
        static::deleted(function ($wareIn) {
            if ($wareIn->ware) {
                $wareIn->ware->decrement('stock', $wareIn->amount);
            }
        });
    }
}
