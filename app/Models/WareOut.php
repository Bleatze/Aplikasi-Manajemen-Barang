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
        // Tambah: stok berkurang
        static::created(function ($wareOut) {
            if ($wareOut->ware) {
                $wareOut->ware->decrement('stock', $wareOut->amount);
            }
        });

        // Edit: jika ware_id berubah, stok lama ditambah kembali, stok baru dikurangi
        static::updated(function ($wareOut) {
            $originalWareId = $wareOut->getOriginal('ware_id');
            $originalAmount = $wareOut->getOriginal('amount');

            if ($originalWareId != $wareOut->ware_id) {
                $oldWare = Ware::find($originalWareId);
                if ($oldWare) {
                    $oldWare->increment('stock', $originalAmount);
                }

                if ($wareOut->ware) {
                    $wareOut->ware->decrement('stock', $wareOut->amount);
                }
            } else {
                $selisih = $wareOut->amount - $originalAmount;
                if ($wareOut->ware && $selisih !== 0) {
                    $wareOut->ware->decrement('stock', $selisih);
                }
            }
        });

        // Hapus: stok dikembalikan
        static::deleted(function ($wareOut) {
            if ($wareOut->ware) {
                $wareOut->ware->increment('stock', $wareOut->amount);
            }
        });
    }
}
