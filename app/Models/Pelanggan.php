<?php

namespace App\Models;
use App\Models\Kontak;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'no_hp'
    ];

    public function pesanan()
    {
        return $this->hasMany(
            Pesanan::class,
            'id_pelanggan'
        );
    }

    public function kontak()
    {
        return $this->hasMany(
            Kontak::class,
            'id_pelanggan'
        );
    }

 
}