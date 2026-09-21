<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\MetodePembayaran;
use Carbon\Carbon;
use App\Models\Kontak;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // =========================
    // ADMIN PRODUK
    // =========================

    public function index(Request $request)
    {
        $search = $request->search;

        $produk = Produk::where(
                        'nama_produk',
                        'like',
                        "%$search%"
                    )
                    ->latest()
                    ->paginate(5);

        // =========================
        // STATISTIK PRODUK
        // =========================

        $totalProduk = Produk::count();

        $produkBulanIni = Produk::whereMonth(
                'created_at',
                Carbon::now()->month
            )
            ->whereYear(
                'created_at',
                Carbon::now()->year
            )
            ->count();

        $produkTahunIni = Produk::whereYear(
                'created_at',
                Carbon::now()->year
            )
            ->count();

        return view('produk.index', compact(
            'produk',
            'search',
            'totalProduk',
            'produkBulanIni',
            'produkTahunIni'
        ));
    }

    // Form tambah produk
    public function create()
    {
        return view('produk.create');
    }

    // Simpan produk
    public function store(Request $request)
    {
        $request->validate([

            'nama_produk' => 'required',

            'harga' => 'required|numeric|min:0',

            'stok' => 'required|numeric|min:0',

            'deskripsi' => 'nullable',

            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:20480',

        ]);

        $gambar = null;

        if($request->hasFile('gambar')){

            $gambar = $request
                ->file('gambar')
                ->store('produk','public');

        }

        Produk::create([

            'nama_produk' => $request->nama_produk,

            'harga' => $request->harga,

            'stok' => $request->stok,

            'deskripsi' => $request->deskripsi,

            'gambar' => $gambar

        ]);

        return redirect()
            ->route('produk.index')
            ->with(
                'success',
                'Produk berhasil ditambahkan'
            );
    }

    // Form edit produk
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        return view(
            'produk.edit',
            compact('produk')
        );
    }

    // Update produk
   public function update(Request $request, $id)
    {
        $request->validate([

            'nama_produk' => 'required',

            'harga' => 'required|numeric|min:0',

            'stok' => 'required|numeric|min:0',

            'deskripsi' => 'nullable',

            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:20480',

        ]);

        $produk = Produk::findOrFail($id);

        $gambar = $produk->gambar;

        if($request->hasFile('gambar')){

            if($produk->gambar){

                Storage::disk('public')->delete(
                    $produk->gambar
                );

            }

            $gambar = $request
                ->file('gambar')
                ->store('produk','public');

        }

        $produk->update([

            'nama_produk' => $request->nama_produk,

            'harga' => $request->harga,

            'stok' => $request->stok,

            'deskripsi' => $request->deskripsi,

            'gambar' => $gambar

        ]);

        return redirect()
            ->route('produk.index')
            ->with(
                'success',
                'Produk berhasil diupdate'
            );
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with(
                'success',
                'Produk berhasil dihapus'
            );
    }

    // =========================
    // PELANGGAN
    // =========================

    public function produkPelanggan()
    {
        $produk = Produk::all();

        $metode = MetodePembayaran::all();

        return view(
            'pelanggan.produk',
            compact(
                'produk',
                'metode'
            )
        );
    }


// LANDING PAGE

    public function landing()
    {
        $produk = Produk::all();

        $review = Kontak::with([
            'produk',
            'pelanggan'
        ])
        ->whereNotNull('rating')
        ->latest()
        ->get();

       
        // Statistik Rating

        $totalReview = Kontak::whereNotNull('rating')->count();

        $rataRating = round(
            Kontak::whereNotNull('rating')->avg('rating') ?? 0,
            1
        );

        $bintang5 = Kontak::where('rating', 5)->count();

        $bintang4 = Kontak::where('rating', 4)->count();

        $bintang3 = Kontak::where('rating', 3)->count();

        $bintang2 = Kontak::where('rating', 2)->count();

        $bintang1 = Kontak::where('rating', 1)->count();

        
        // Produk yang dipilih dari halaman Pesanan Saya

        $produkDipilih = request('produk');

        $pesananDipilih = request('pesanan');


        // Produk yang boleh direview


        $produkReview = \App\Models\DetailPesanan::with([
            'produk',
            'pesanan'
        ])
        ->whereHas('pesanan', function ($q) {

            $q->where('id_pelanggan', session('pelanggan_id'))
            ->where('status_pesanan', 'selesai');

        })
        ->latest('id_detail')
        ->get();

        return view(
            'landing',
            compact(
                'produk',
                'review',
                'produkReview',

                // digunakan agar dropdown otomatis memilih produk
                // saat pelanggan klik tombol "Beri Review"
                'produkDipilih',
                'pesananDipilih',

                'totalReview',
                'rataRating',
                'bintang5',
                'bintang4',
                'bintang3',
                'bintang2',
                'bintang1'
            )
        );
    }
}