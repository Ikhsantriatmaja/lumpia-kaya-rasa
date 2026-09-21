<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_pesanan',
        'id_produk',
        'jumlah',
        'subtotal'
    ];

    // Relasi: detail milik 1 pesanan
   public function pesanan()
    {
        return $this->belongsTo(
            Pesanan::class,
            'id_pesanan'
        );
    }

    // Relasi: detail milik 1 produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}