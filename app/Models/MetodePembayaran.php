<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    protected $table = 'metode_pembayaran';

    protected $primaryKey = 'id_metode_pembayaran';

    protected $fillable = [

        'nama_metode',

        'qris'

    ];

    // =========================
    // RELASI KE PEMBAYARAN
    // =========================

    public function pembayaran()
    {
        return $this->hasMany(
            Pembayaran::class,
            'id_metode_pembayaran',
            'id_metode_pembayaran'
        );
    }
}