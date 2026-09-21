<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\MetodePembayaran;
use App\Models\DetailPesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // STATISTIK UTAMA
        // =========================

        $totalProduk = Produk::count();
        $totalPelanggan = Pelanggan::count();
        $totalPesanan = Pesanan::count();
        $totalMetode = MetodePembayaran::count();

        // =========================
        // STATUS PESANAN
        // =========================

        $pending = Pesanan::where(
            'status_pesanan',
            'pending'
        )->count();

        $diproses = Pesanan::where(
            'status_pesanan',
            'diproses'
        )->count();

        $selesai = Pesanan::where(
            'status_pesanan',
            'selesai'
        )->count();

        // =========================
        // OMSET
        // =========================

        $omsetHariIni = Pesanan::whereDate(
            'created_at',
            Carbon::today()
        )->sum('total_harga');

        $omsetMingguIni = Pesanan::whereBetween(
            'created_at',
            [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]
        )->sum('total_harga');

        $omsetBulanIni = Pesanan::whereMonth(
            'created_at',
            Carbon::now()->month
        )
        ->whereYear(
            'created_at',
            Carbon::now()->year
        )
        ->sum('total_harga');

        $omsetTahunIni = Pesanan::whereYear(
            'created_at',
            Carbon::now()->year
        )->sum('total_harga');

        // =========================
        // PESANAN TERBARU
        // =========================

        $pesananTerbaru = Pesanan::with('pelanggan')
            ->latest()
            ->take(5)
            ->get();

        // =========================
        // PRODUK TERLARIS BULAN INI
        // =========================

        $produkTerlaris = DetailPesanan::join(
                'produk',
                'detail_pesanan.id_produk',
                '=',
                'produk.id_produk'
            )
            ->join(
                'pesanan',
                'detail_pesanan.id_pesanan',
                '=',
                'pesanan.id_pesanan'
            )
            ->whereMonth(
                'pesanan.created_at',
                Carbon::now()->month
            )
            ->whereYear(
                'pesanan.created_at',
                Carbon::now()->year
            )
            ->select(
                'produk.nama_produk',
                DB::raw('SUM(detail_pesanan.jumlah) as total_terjual')
            )
            ->groupBy('produk.nama_produk')
            ->orderByDesc('total_terjual')
            ->take(10)
            ->get();

        $namaProduk = $produkTerlaris
            ->pluck('nama_produk')
            ->toArray();

        $jumlahProduk = $produkTerlaris
            ->pluck('total_terjual')
            ->toArray();

        // =========================
        // PENJUALAN HARIAN BULAN INI
        // =========================

        $penjualanHarian = Pesanan::select(
                DB::raw('DAY(created_at) as hari'),
                DB::raw('SUM(total_harga) as total')
            )
            ->whereMonth(
                'created_at',
                Carbon::now()->month
            )
            ->whereYear(
                'created_at',
                Carbon::now()->year
            )
            ->groupBy('hari')
            ->orderBy('hari')
            ->get();

        $tanggalPenjualan = $penjualanHarian
            ->pluck('hari')
            ->toArray();

        $totalPenjualanHarian = $penjualanHarian
            ->pluck('total')
            ->toArray();

        // =========================
        // VIEW
        // =========================

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalPelanggan',
            'totalPesanan',
            'totalMetode',

            'pending',
            'diproses',
            'selesai',

            'omsetHariIni',
            'omsetMingguIni',
            'omsetBulanIni',
            'omsetTahunIni',

            'pesananTerbaru',

            'produkTerlaris',
            'penjualanHarian',

            'namaProduk',
            'jumlahProduk',

            'tanggalPenjualan',
            'totalPenjualanHarian'
        ));
    }
}