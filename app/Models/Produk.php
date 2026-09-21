<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use App\Models\Kontak;

class Produk extends Model
{
    protected $table = 'produk' ;
    protected $primaryKey = 'id_produk';

    protected $fillable = [

    'nama_produk',

    'harga',

    'deskripsi',

    'stok',

    'gambar'

];

    // Relasi: 1 produk punya banyak detail pesanan
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 
        'id_produk'
        );
    }
    

     public function kontak()
    {
        return $this->hasMany(
                Kontak::class,
                'id_produk'
        );
     }

}