<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class SawController extends Controller
{
    public function index()
    {
        $produk = Produk::with([
            'detailPesanan.pesanan',
            'kontak'
        ])->get();

        $data = [];

        foreach($produk as $p){

            $jumlahTerjual =
                $p->detailPesanan
                ->sum('jumlah');

            $rating =
                round(
                    $p->kontak
                    ->avg('rating') ?? 0,
                    1
                );

            $stok =
                $p->stok;

            $harga =
                $p->harga;

            $data[] = [

                'produk' => $p,

                'penjualan' =>
                    $jumlahTerjual,

                'rating' =>
                    $rating,

                'stok' =>
                    $stok,

                'harga' =>
                    $harga,
            ];
        }



        $maxPenjualan =
            collect($data)
            ->max('penjualan');

        $maxRating =
            collect($data)
            ->max('rating');

        $maxStok =
            collect($data)
            ->max('stok');

        $maxHarga =
            collect($data)
            ->max('harga');

        foreach($data as &$d){

            $n1 =
                $maxPenjualan
                ? $d['penjualan']
                / $maxPenjualan : 0;

            $n2 =
                $maxRating
                ? $d['rating']
                / $maxRating : 0;

            $n3 =
                $maxStok
                ? $d['stok']
                / $maxStok : 0;

            $n4 =
                $maxHarga
                ? $d['harga']
                / $maxHarga : 0;



            $d['nilai'] =

                ($n1 * 0.40) +
                ($n2 * 0.30) +
                ($n3 * 0.10) +
                ($n4 * 0.20);
        }

        usort($data,function($a,$b){

            return
            $b['nilai']
            <=> $a['nilai'];

        });

        return view(
            'admin.saw.index',
            compact('data')
        );
    }
}