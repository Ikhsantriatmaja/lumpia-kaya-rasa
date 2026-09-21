<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\DetailPesanan;
use App\Models\Pembayaran;
use App\Models\MetodePembayaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $minggu = $request->minggu;
        
        // Buat variabel pembantu untuk sinkronisasi select option di view index
        $filter_waktu = $request->filter_waktu;

        $query = Pesanan::with([
            'pelanggan',
            'pembayaran.metodePembayaran'
        ]);

        // Filter: Pencarian Nama atau Email Pelanggan
        if ($search) {
            $query->whereHas('pelanggan', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Jalur Logika 1: Jika menggunakan filter cepat (Minggu Ini, Bulan Ini, Tahun Ini)
        if ($filter_waktu) {
            if ($filter_waktu == 'minggu_ini') {
                $query->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            } elseif ($filter_waktu == 'bulan_ini') {
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
            } elseif ($filter_waktu == 'tahun_ini') {
                $query->whereYear('created_at', Carbon::now()->year);
            }
        } 
        
        // Jalur Logika 2: Mengakomodasi filter manual breakdown (jika dipanggil dari halaman lain)
        else {
            if ($bulan) {
                $query->whereMonth('created_at', $bulan);
            }
            if ($tahun) {
                $query->whereYear('created_at', $tahun);
            }
            if ($minggu) {
                $tahunAktif = $tahun ? $tahun : date('Y');
                $awal = Carbon::now()->setISODate($tahunAktif, $minggu)->startOfWeek();
                $akhir = Carbon::now()->setISODate($tahunAktif, $minggu)->endOfWeek();
                $query->whereBetween('created_at', [$awal, $akhir]);
            }
        }

        // Ambil data koleksi pesanan yang telah disaring
        $pesanan = (clone $query)
                ->latest('id_pesanan')
                ->paginate(10)
                ->withQueryString();

        // Hitung akumulasi statistik secara dinamis dari hasil saringan query aktif
       $totalPesanan =
            (clone $query)->count();

        $pending =
            (clone $query)
                ->where('status_pesanan','pending')
                ->count();

        $diproses =
            (clone $query)
                ->where('status_pesanan','diproses')
                ->count();

        $selesai =
            (clone $query)
                ->where('status_pesanan','selesai')
                ->count();

        return view('pesanan.index', compact(
            'pesanan',
            'search',
            'bulan',
            'tahun',
            'minggu',
            'filter_waktu',
            'totalPesanan',
            'pending',
            'diproses',
            'selesai'
        ));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();
        $metodePembayaran = MetodePembayaran::all();

        return view('pesanan.create', compact('pelanggan', 'produk', 'metodePembayaran'));
    }

    public function store(Request $request)
{
        // =========================
        // CEK PELANGGAN
        // =========================

        if ($request->jenis_pelanggan == 'baru') {

            $pelanggan = Pelanggan::create([

                'nama' => $request->nama_baru,

                'email' => $request->email_baru,

                'password' => bcrypt('12345678'),

                'no_hp' => $request->no_hp_baru,

                'alamat' => $request->alamat_baru

            ]);

            $idPelanggan = $pelanggan->id_pelanggan;

        } else {

            $idPelanggan = $request->id_pelanggan;

        }

        // =========================
        // PRODUK
        // =========================

        $produk = Produk::findOrFail($request->id_produk);

        $subtotal = $produk->harga * $request->jumlah;

        // =========================
        // PESANAN
        // =========================

        $pesanan = Pesanan::create([

            'id_pelanggan'   => $idPelanggan,

            'tanggal_pesanan'=> now(),

            'total_harga'    => $subtotal,

            'status_pesanan' => 'selesai',

            'jenis_pesanan'  => 'offline'

        ]);

        // =========================
        // DETAIL PESANAN
        // =========================

        DetailPesanan::create([

            'id_pesanan' => $pesanan->id_pesanan,

            'id_produk'  => $request->id_produk,

            'jumlah'     => $request->jumlah,

            'subtotal'   => $subtotal

        ]);

        // =========================
        // UPDATE STOK
        // =========================

        $produk->stok -= $request->jumlah;

        $produk->save();

        // =========================
        // BUKTI PEMBAYARAN
        // =========================

        $bukti = null;

        if ($request->hasFile('bukti_pembayaran')) {

            $bukti = $request
                ->file('bukti_pembayaran')
                ->store('bukti-transfer', 'public');

        }

        // =========================
        // PEMBAYARAN
        // =========================

        Pembayaran::create([

            'id_pesanan' => $pesanan->id_pesanan,

            'id_metode_pembayaran' => $request->id_metode_pembayaran,

            'bukti_pembayaran' => $bukti,

            'status_pembayaran' => 'lunas',

            'tanggal_pembayaran' => now()

        ]);

        return redirect()
            ->route('pesanan.index')
            ->with(
                'success',
                'Pesanan offline berhasil ditambahkan.'
            );
    }
    public function laporan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $search = $request->search;

        $query = Pesanan::with(['pelanggan', 'detailPesanan.produk']);

        if ($bulan) { $query->whereMonth('created_at', $bulan); }
        if ($tahun) { $query->whereYear('created_at', $tahun); }
        if ($search) {
            $query->whereHas('pelanggan', function($q) use ($search){
                $q->where('nama', 'like', "%$search%");
            });
        }

        $totalPesanan = (clone $query)->count();
        $totalOmset = (clone $query)->sum('total_harga');

        $pesananHariIni = Pesanan::whereDate('created_at', Carbon::today())->count();
        $omsetHariIni = Pesanan::whereDate('created_at', Carbon::today())->sum('total_harga');

        $pesananMingguIni = Pesanan::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $omsetMingguIni = Pesanan::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_harga');

        $pesananBulanIni = Pesanan::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count();
        $omsetBulanIni = Pesanan::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('total_harga');

        $riwayatPesanan = (clone $query)->latest('id_pesanan')->paginate(10) ->withQueryString();

        return view('pesanan.laporan', compact(
            'totalPesanan', 'totalOmset', 'pesananHariIni', 'omsetHariIni',
            'pesananMingguIni', 'omsetMingguIni', 'pesananBulanIni', 'omsetBulanIni',
            'riwayatPesanan', 'bulan', 'tahun', 'search'
        ));
    }

    public function exportPdf(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Pesanan::with(['pelanggan', 'detailPesanan.produk']);

        if ($bulan) { $query->whereMonth('created_at', $bulan); }
        if ($tahun) { $query->whereYear('created_at', $tahun); }

        $pesanan = $query->latest('id_pesanan')->get();
        $totalOmset = $pesanan->sum('total_harga');
        $tanggalCetak = Carbon::now();

        $pdf = Pdf::loadView('pesanan.laporan_pdf', compact('pesanan', 'totalOmset', 'bulan', 'tahun', 'tanggalCetak'));
        return $pdf->download('laporan-penjualan.pdf');
    }

    public function show($id)
    {
        $pesanan = Pesanan::with('detailPesanan.produk', 'pembayaran.metodePembayaran')->findOrFail($id);
        return view('pesanan.show', compact('pesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status_pesanan = $request->status_pesanan;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status berhasil diupdate');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'id_produk' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'id_metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240'
        ]);

        if (!session('pelanggan_id')) {

            return redirect()
                ->route('pelanggan.login')
                ->with(
                    'error',
                    'Session login berakhir, silakan login kembali.'
                );

        }

        $produk = Produk::findOrFail($request->id_produk);
        $jumlah = $request->jumlah;
        $subtotal = $produk->harga * $jumlah;

        $bukti = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $bukti = $request->file('bukti_pembayaran')->store('bukti-transfer', 'public');
        }

        $pesanan = Pesanan::create([

            'id_pelanggan' => session('pelanggan_id'),

            'tanggal_pesanan' => now(),

            'total_harga' => $subtotal,

            'status_pesanan' => 'pending',

            'jenis_pesanan' => 'online'

        ]);

        DetailPesanan::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_produk' => $produk->id_produk,
            'jumlah' => $jumlah,
            'subtotal' => $subtotal
        ]);

        Pembayaran::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_metode_pembayaran' => $request->id_metode_pembayaran,
            'bukti_pembayaran' => $bukti,
            'status_pembayaran' => 'pending',
            'tanggal_pembayaran' => now()
        ]);

        $produk->stok = $produk->stok - $jumlah;
        $produk->save();

        return redirect('/pesanan-saya')->with('success', 'Pesanan berhasil dibuat dan bukti transfer berhasil diupload');
    }

    public function pesananSaya()
    {
        $pesanan = Pesanan::with('detailPesanan.produk', 'pembayaran.metodePembayaran')
            ->where('id_pelanggan', session('pelanggan_id'))
            ->get();

        return view('pelanggan.pesanan', compact('pesanan'));
    }
}