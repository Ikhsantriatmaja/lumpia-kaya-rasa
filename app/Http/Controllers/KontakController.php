<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;
use App\Models\Pelanggan;
use App\Models\Pesanan;

class KontakController extends Controller
{
    // =========================
    // SIMPAN REVIEW PELANGGAN
    // =========================

    public function store(Request $request)
    {
        $request->validate([

            'id_produk'     => 'required',

            'rating'        => 'required',

            'pesan'         => 'required',

            'foto_produk'   => 'required|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $pelanggan = Pelanggan::find(session('pelanggan_id'));

        if (!$pelanggan) {

            return back()->with(
                'error',
                'Silakan login terlebih dahulu.'
            );

        }

        // =========================
        // CEK SUDAH PERNAH MEMBELI
        // =========================

        $cekPembelian = Pesanan::where(
                'id_pelanggan',
                session('pelanggan_id')
            )
            ->whereHas('detailPesanan', function ($q) use ($request) {

                $q->where(
                    'id_produk',
                    $request->id_produk
                );

            })
            ->exists();

        if (!$cekPembelian) {

            return back()->with(
                'error',
                'Anda harus membeli produk terlebih dahulu sebelum memberikan review.'
            );

        }

        // =========================
        // UPLOAD FOTO
        // =========================

        $foto = $request
            ->file('foto_produk')
            ->store('review', 'public');

        // =========================
        // SIMPAN REVIEW
        // =========================

        Kontak::create([

            'id_pelanggan' => $pelanggan->id_pelanggan,

            'id_produk'    => $request->id_produk,

            'nama'         => $pelanggan->nama,

            'email'        => $pelanggan->email,

            'pesan'        => $request->pesan,

            'rating'       => $request->rating,

            'foto_produk'  => $foto

        ]);

        return back()->with(
            'success',
            'Penilaian berhasil dikirim.'
        );
    }

    // =========================
    // ADMIN - PESAN MASUK
    // =========================

    public function index()
    {
        $kontak = Kontak::with([

                'pelanggan',

                'produk'

            ])
            ->latest()
            ->paginate(6);

        return view(
            'admin.kontak.index',
            compact('kontak')
        );
    }

    // =========================
    // JUMLAH PESAN
    // =========================

    public function count()
    {
        return Kontak::count();
    }

    // =========================
    // BALAS REVIEW pelanggan
    // =========================

    public function balas(Request $request, $id)
    {
        $request->validate([

            'balasan_admin' => 'required'

        ]);

        $kontak = Kontak::findOrFail($id);

        $kontak->balasan_admin = $request->balasan_admin;

        $kontak->save();

        return back()->with(
            'success',
            'Balasan berhasil dikirim.'
        );
    }
}