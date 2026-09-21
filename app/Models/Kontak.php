<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pelanggan;

class Kontak extends Model
{
    protected $table = 'kontak';

   protected $fillable = [

        'id_pelanggan',

        'id_pesanan',

        'id_produk',

        'nama',

        'email',

        'pesan',

        'rating',

        'foto_produk',

        'balasan_admin'

    ];

    public function pelanggan()
    {
        return $this->belongsTo(
            Pelanggan::class,
            'id_pelanggan'
        );
    }

    public function produk()
    {
        return $this->belongsTo(
            Produk::class,
            'id_produk'
        );
    }
}