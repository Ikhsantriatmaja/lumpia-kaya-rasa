@extends('layouts.pelanggan')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* =========================================================
       BAGIAN 1: PENGATURAN WARNA DASAR (VARIABEL)
       Ini mempermudah jika nanti Anda ingin ganti warna. 
       Cukup ganti kode warna di sini, semua akan berubah.
       ========================================================= */
    :root {
        --warna-emas: #C69656;
        --warna-gelap: #121212;
        --warna-teks-utama: #0F172A;
        --warna-teks-pudar: #64748B;
        --background-abu: #F8FAFC;
    }

    /* Mengatur font seluruh halaman dashboard */
    .dashboard-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--background-abu);
        min-height: 100vh;
        padding-top: 40px; /* Jarak dari navbar atas */
        padding-bottom: 60px;
    }

    /* =========================================================
       BAGIAN 2: KOTAK SAMBUTAN (HERO SECTION)
       Desain kotak hitam besar di bagian atas dashboard
       ========================================================= */
    .kotak-sambutan {
        background-color: var(--warna-gelap);
        color: white;
        padding: 45px 50px;
        border-radius: 24px; /* Membuat ujung kotak melengkung */
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08); /* Efek bayangan */
        position: relative;
        overflow: hidden; /* Mencegah hiasan keluar dari kotak */
    }
    
    /* Hiasan cahaya emas melingkar di pojok kanan atas kotak sambutan */
    .kotak-sambutan::before {
        content: '';
        position: absolute;
        top: -50px; right: -50px;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(198, 150, 86, 0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    /* =========================================================
       BAGIAN 3: KARTU STATISTIK (ANGKA PESANAN)
       4 kotak putih yang berisi jumlah pesanan, pending, dll
       ========================================================= */
    .kartu-statistik {
        background: white;
        padding: 24px;
        border-radius: 20px;
        border: 1px solid #E2E8F0; /* Garis pinggir tipis */
        display: flex; /* Menyusun ikon dan teks menyamping */
        align-items: center;
        gap: 20px; /* Jarak antara ikon dan teks */
        transition: 0.3s; /* Efek halus saat di-hover */
    }
    
    /* Efek ketika mouse diarahkan ke kartu statistik (naik sedikit) */
    .kartu-statistik:hover {
        transform: translateY(-5px); 
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    /* Pembungkus warna untuk ikon di dalam kartu */
    .bungkus-ikon {
        width: 55px; height: 55px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
    }

    /* =========================================================
       BAGIAN 4: TABEL RIWAYAT PESANAN
       ========================================================= */
    .kotak-tabel {
        background: white;
        border-radius: 24px;
        padding: 35px;
        border: 1px solid #E2E8F0;
    }

    /* Tombol "Lihat Semua" */
    .tombol-emas {
        border: 1px solid var(--warna-emas);
        color: var(--warna-emas);
        border-radius: 10px;
        font-weight: 600;
        padding: 8px 18px;
        text-decoration: none;
        transition: 0.3s;
    }
    .tombol-emas:hover {
        background: var(--warna-emas);
        color: white;
    }

    /* Pengaturan jarak dan garis pada tabel */
    .tabel-keren { width: 100%; border-collapse: collapse; }
    .tabel-keren th { 
        padding: 15px; 
        color: var(--warna-teks-pudar); 
        border-bottom: 2px solid #E2E8F0; 
        text-align: left; 
    }
    .tabel-keren td { 
        padding: 15px; 
        border-bottom: 1px solid #F1F5F9; 
    }
    
    /* Baris tabel berubah warna abu-abu terang saat di-hover */
    .tabel-keren tbody tr:hover td { background-color: #F8FAFC; }

    /* =========================================================
       BAGIAN 5: LABEL STATUS (BADGES) DENGAN TITIK (DOT)
       ========================================================= */
    .label-status { 
        display: inline-flex; align-items: center; gap: 6px; 
        padding: 6px 14px; border-radius: 50px; font-weight: 600; font-size: 0.85rem;
    }
    .titik { width: 8px; height: 8px; border-radius: 50%; } /* Titik bulat kecil */
    
    /* Pewarnaan masing-masing status */
    .status-pending { background: #FFFBEB; color: #B45309; }
    .status-pending .titik { background: #F59E0B; }
    
    .status-diproses { background: #EFF6FF; color: #1D4ED8; }
    .status-diproses .titik { background: #3B82F6; }
    
    .status-selesai { background: #ECFDF5; color: #047857; }
    .status-selesai .titik { background: #10B981; }
</style>

<div class="dashboard-wrapper">
    <div class="container">
        
        <div class="kotak-sambutan mb-5">
            <h1 style="font-weight: 800; font-size: 2.2rem; margin-bottom: 10px; position: relative; z-index: 2;">
                Halo, <span style="color: var(--warna-emas);">{{ session('pelanggan_nama') }}!</span> 👋
            </h1>
            <p style="color: #94A3B8; font-size: 1.1rem; margin: 0; position: relative; z-index: 2;">
                Selamat datang di panel pelanggan. Pantau pesanan Anda, cek riwayat transaksi, dan nikmati kembali cita rasa otentik kami.
            </p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="kartu-statistik">
                    <div class="bungkus-ikon" style="background: #F1F5F9; color: var(--warna-teks-utama);">
                        <i class="bi bi-bag-check"></i>
                    </div>
                    <div>
                        <span style="font-size: 0.85rem; color: var(--warna-teks-pudar); font-weight: 600;">TOTAL PESANAN</span>
                        <h3 style="margin: 0; font-weight: 800;">{{ $totalPesanan }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="kartu-statistik">
                    <div class="bungkus-ikon" style="background: #FFFBEB; color: #F59E0B;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <span style="font-size: 0.85rem; color: var(--warna-teks-pudar); font-weight: 600;">MENUNGGU</span>
                        <h3 style="margin: 0; font-weight: 800;">{{ $pending }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="kartu-statistik">
                    <div class="bungkus-ikon" style="background: #EFF6FF; color: #3B82F6;">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <span style="font-size: 0.85rem; color: var(--warna-teks-pudar); font-weight: 600;">DIPROSES</span>
                        <h3 style="margin: 0; font-weight: 800;">{{ $diproses }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="kartu-statistik">
                    <div class="bungkus-ikon" style="background: #ECFDF5; color: #10B981;">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div>
                        <span style="font-size: 0.85rem; color: var(--warna-teks-pudar); font-weight: 600;">SELESAI</span>
                        <h3 style="margin: 0; font-weight: 800;">{{ $selesai }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="kotak-tabel">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 style="font-weight: 800; margin: 0; color: var(--warna-teks-utama);">Riwayat Pesanan</h4>
                <a href="/pesanan-saya" class="tombol-emas">
                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="table-responsive">
                <table class="tabel-keren">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Total Tagihan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatPesanan as $pesanan)
                        <tr>
                            <td>
                                <strong>#{{ $pesanan->id_pesanan }}</strong>
                            </td>
                            <td style="color: var(--warna-teks-pudar);">
                                {{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}
                            </td>
                            <td style="color: var(--warna-emas); font-weight: bold;">
                                Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                            </td>
                            <td>
                                @if($pesanan->status_pesanan == 'pending')
                                    <span class="label-status status-pending"><div class="titik"></div> Pending</span>
                                @elseif($pesanan->status_pesanan == 'diproses')
                                    <span class="label-status status-diproses"><div class="titik"></div> Diproses</span>
                                @elseif($pesanan->status_pesanan == 'selesai')
                                    <span class="label-status status-selesai"><div class="titik"></div> Selesai</span>
                                @else
                                    <span class="label-status" style="background: #F1F5F9; color: #475569;">
                                        <div class="titik" style="background: #94A3B8;"></div> {{ ucfirst($pesanan->status_pesanan) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-receipt" style="font-size: 3rem; color: #CBD5E1;"></i>
                                <h5 class="mt-3 fw-bold">Belum Ada Transaksi</h5>
                                <p class="text-muted mb-4">Anda belum melakukan pemesanan apapun.</p>
                                <a href="/produk" class="tombol-emas px-4 py-2">Pesan Sekarang</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection