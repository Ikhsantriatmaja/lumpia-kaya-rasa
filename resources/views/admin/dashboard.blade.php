@extends('layouts.admin')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Base Environment */
    .pro-dashboard {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #FAFBFC; /* Latar yang sangat lembut, ramah di mata */
        color: #0F172A;
        padding: 32px 24px;
        min-height: 100vh;
    }

    /* Kartu (Pro Cards) dengan Shadow Bertingkat */
    .pro-card {
        background: #FFFFFF;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0px 4px 24px -8px rgba(15, 23, 42, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .pro-card:hover {
        box-shadow: 0px 12px 32px -8px rgba(15, 23, 42, 0.08);
        transform: translateY(-2px);
        border-color: #CBD5E1;
    }

    /* Grid Layouts */
    .grid-4 { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .grid-3 { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .grid-2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 24px; margin-bottom: 32px; }

    /* KPI Mini Cards */
    .kpi-title { font-size: 0.8125rem; font-weight: 600; color: #64748B; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px; }
    .kpi-value { font-size: 1.5rem; font-weight: 800; color: #0F172A; margin: 0; letter-spacing: -0.02em; }
    .kpi-wrapper { display: flex; justify-content: space-between; align-items: flex-start; }

    /* Ikon Berkelas dengan Glass Effect Muted */
    .icon-box {
        width: 44px; height: 44px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
    }
    .icon-emerald { background: #ECFDF5; color: #059669; border: 1px solid #D1FAE5; }
    .icon-indigo  { background: #EEF2FF; color: #4F46E5; border: 1px solid #E0E7FF; }
    .icon-amber   { background: #FFFBEB; color: #D97706; border: 1px solid #FEF3C7; }
    .icon-rose    { background: #FFF1F2; color: #E11D48; border: 1px solid #FFE4E6; }

    /* Header Bagian */
    .section-title {
        font-size: 1.125rem; font-weight: 700; color: #0F172A; margin-bottom: 20px;
        letter-spacing: -0.01em; display: flex; align-items: center; gap: 10px;
    }
    .section-dot { width: 8px; height: 8px; border-radius: 50%; }

    /* Tabel Premium */
    .pro-table { width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; }
    .pro-table th { 
        padding: 16px 20px; font-size: 0.75rem; font-weight: 700; color: #64748B; 
        text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #E2E8F0; 
    }
    .pro-table td { 
        padding: 16px 20px; font-size: 0.875rem; font-weight: 500; color: #334155; 
        border-bottom: 1px solid #F1F5F9; transition: background 0.2s;
    }
    .pro-table tbody tr:hover td { background-color: #F8FAFC; }
    .pro-table tbody tr:last-child td { border-bottom: none; }

    /* Status Badge ala Vercel (Titik + Teks) */
    .status-badge { 
        display: inline-flex; align-items: center; padding: 6px 12px; 
        border-radius: 999px; font-size: 0.75rem; font-weight: 700; border: 1px solid transparent;
    }
    .status-dot { width: 6px; height: 6px; border-radius: 50%; margin-right: 8px; }
    
    .badge-pending { background: #FFFBEB; color: #B45309; border-color: #FEF3C7; }
    .badge-pending .status-dot { background: #F59E0B; box-shadow: 0 0 8px #F59E0B; }
    
    .badge-diproses { background: #F0F9FF; color: #0369A1; border-color: #E0F2FE; }
    .badge-diproses .status-dot { background: #0EA5E9; box-shadow: 0 0 8px #0EA5E9; }
    
    .badge-selesai { background: #ECFDF5; color: #047857; border-color: #D1FAE5; }
    .badge-selesai .status-dot { background: #10B981; box-shadow: 0 0 8px #10B981; }

    .badge-default { background: #F8FAFC; color: #475569; border-color: #E2E8F0; }
    .badge-default .status-dot { background: #94A3B8; }
</style>

<div class="pro-dashboard">

    <div style="margin-bottom: 36px;">
        <h2 style="font-size: 1.75rem; font-weight: 800; margin: 0 0 6px 0; letter-spacing: -0.03em;">Dashboard Admin</h2>
        <p style="color: #64748B; font-size: 0.9375rem; margin: 0; font-weight: 500;">Pusat kendali utama operasional dan analitik Lumpia Kaya Rasa.</p>
    </div>

    <div class="pro-card" style="background: linear-gradient(105deg, #0F172A 0%, #1E293B 100%); color: #FFFFFF; margin-bottom: 40px; border: none; position: relative; overflow: hidden; padding: 32px;">
        <div style="position: relative; z-index: 2;">
            <h4 style="font-size: 1.35rem; font-weight: 700; margin: 0 0 10px 0;">Selamat Datang, {{ session('admin_nama') }}! 🚀</h4>
            <p style="color: #94A3B8; font-size: 0.9375rem; margin: 0; max-width: 650px; line-height: 1.6; font-weight: 400;">
                Kelola seluruh siklus pemesanan pelanggan, perbarui inventaris, monitor laporan finansial harian, dan respons umpan balik dari pelanggan langsung melalui panel ini.
            </p>
        </div>
        <div style="position: absolute; right: -80px; top: -80px; width: 350px; height: 350px; background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, rgba(99, 102, 241, 0) 70%); border-radius: 50%;"></div>
        <div style="position: absolute; right: 150px; bottom: -100px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0) 70%); border-radius: 50%;"></div>
    </div>


    <div class="section-title">
        <div class="section-dot" style="background: #10B981;"></div> Performa Finansial
    </div>
    <div class="grid-4">
        <div class="pro-card kpi-wrapper">
            <div>
                <div class="kpi-title">Omset Hari Ini</div>
                <h3 class="kpi-value">Rp {{ number_format($omsetHariIni,0,',','.') }}</h3>
            </div>
            <div class="icon-box icon-emerald">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div class="pro-card kpi-wrapper">
            <div>
                <div class="kpi-title">Omset Minggu Ini</div>
                <h3 class="kpi-value">Rp {{ number_format($omsetMingguIni,0,',','.') }}</h3>
            </div>
            <div class="icon-box icon-emerald">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div class="pro-card kpi-wrapper">
            <div>
                <div class="kpi-title">Omset Bulan Ini</div>
                <h3 class="kpi-value">Rp {{ number_format($omsetBulanIni,0,',','.') }}</h3>
            </div>
            <div class="icon-box icon-emerald">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div class="pro-card kpi-wrapper">
            <div>
                <div class="kpi-title">Omset Tahun Ini</div>
                <h3 class="kpi-value">Rp {{ number_format($omsetTahunIni,0,',','.') }}</h3>
            </div>
            <div class="icon-box icon-emerald">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>


    <div class="section-title">
        <div class="section-dot" style="background: #4F46E5;"></div> Inventaris & Pelanggan
    </div>
    <div class="grid-4">
        <div class="pro-card kpi-wrapper">
            <div>
                <div class="kpi-title">Katalog Produk</div>
                <h3 class="kpi-value">{{ $totalProduk }} <span style="font-size: 0.875rem; color: #94A3B8; font-weight: 600;">Item</span></h3>
            </div>
            <div class="icon-box icon-indigo">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </div>
        <div class="pro-card kpi-wrapper">
            <div>
                <div class="kpi-title">Basis Pelanggan</div>
                <h3 class="kpi-value">{{ $totalPelanggan }} <span style="font-size: 0.875rem; color: #94A3B8; font-weight: 600;">Akun</span></h3>
            </div>
            <div class="icon-box icon-indigo">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>
        <div class="pro-card kpi-wrapper">
            <div>
                <div class="kpi-title">Lalu Lintas Pesanan</div>
                <h3 class="kpi-value">{{ $totalPesanan }} <span style="font-size: 0.875rem; color: #94A3B8; font-weight: 600;">Struk</span></h3>
            </div>
            <div class="icon-box icon-indigo">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
        </div>
        <div class="pro-card kpi-wrapper">
            <div>
                <div class="kpi-title">Kanal Pembayaran</div>
                <h3 class="kpi-value">{{ $totalMetode }} <span style="font-size: 0.875rem; color: #94A3B8; font-weight: 600;">Opsi</span></h3>
            </div>
            <div class="icon-box icon-indigo">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            </div>
        </div>
    </div>


    <div class="section-title">
        <div class="section-dot" style="background: #F59E0B;"></div> Operasional & Logistik
    </div>
    
    <div class="grid-3">
        <div class="pro-card" style="box-shadow: inset 0 4px 0 0 #F59E0B;">
            <div class="kpi-title">Validasi Pending</div>
            <h3 class="kpi-value" style="color: #D97706;">{{ $pending }} <span style="font-size: 0.875rem; color: #94A3B8; font-weight: 600;">Antrean</span></h3>
        </div>
        <div class="pro-card" style="box-shadow: inset 0 4px 0 0 #0EA5E9;">
            <div class="kpi-title">Proses Pengemasan</div>
            <h3 class="kpi-value" style="color: #0284C7;">{{ $diproses }} <span style="font-size: 0.875rem; color: #94A3B8; font-weight: 600;">Diproses</span></h3>
        </div>
        <div class="pro-card" style="box-shadow: inset 0 4px 0 0 #10B981;">
            <div class="kpi-title">Transaksi Berhasil</div>
            <h3 class="kpi-value" style="color: #059669;">{{ $selesai }} <span style="font-size: 0.875rem; color: #94A3B8; font-weight: 600;">Selesai</span></h3>
        </div>
    </div>

    <div class="pro-card" style="margin-bottom: 40px; padding: 0; overflow: hidden;">
        <div style="padding: 20px 24px; border-bottom: 1px solid #F1F5F9; display: flex; justify-content: space-between; align-items: center;">
            <h4 style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #0F172A;">Log Transaksi Terkini</h4>
        </div>
        <div style="overflow-x: auto;">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th style="padding-left: 32px;">ID Pesanan</th>
                        <th>Waktu Masuk</th>
                        <th>Nilai Transaksi</th>
                        <th style="padding-right: 32px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesananTerbaru as $pesanan)
                    <tr>
                        <td style="padding-left: 32px; font-weight: 700; color: #0F172A;">#{{ $pesanan->id_pesanan }}</td>
                        <td style="color: #64748B;">{{ \Carbon\Carbon::parse($pesanan->created_at)->translatedFormat('d M Y, H:i') }}</td>
                        <td style="font-weight: 700; color: #0F172A;">Rp {{ number_format($pesanan->total_harga,0,',','.') }}</td>
                        <td style="padding-right: 32px;">
                            @if($pesanan->status_pesanan == 'pending')
                                <span class="status-badge badge-pending"><span class="status-dot"></span>Pending</span>
                            @elseif($pesanan->status_pesanan == 'diproses')
                                <span class="status-badge badge-diproses"><span class="status-dot"></span>Diproses</span>
                            @elseif($pesanan->status_pesanan == 'selesai')
                                <span class="status-badge badge-selesai"><span class="status-dot"></span>Selesai</span>
                            @else
                                <span class="status-badge badge-default"><span class="status-dot"></span>{{ ucfirst($pesanan->status_pesanan) }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 40px; color: #94A3B8; font-weight: 500;">
                            Belum ada aktivitas transaksi terekam.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <div class="section-title">
        <div class="section-dot" style="background: #6366F1;"></div> Analitik Visual
    </div>
    
    <div class="grid-2">
        <div class="pro-card">
            <h4 style="margin: 0 0 24px 0; font-size: 1.05rem; font-weight: 700;">Distribusi Produk Terlaris</h4>
            <div style="position: relative; width: 100%; height: 320px;">
                <canvas id="produkChart"></canvas>
            </div>
        </div>

        <div class="pro-card">
            <h4 style="margin: 0 0 24px 0; font-size: 1.05rem; font-weight: 700;">Tren Pendapatan Harian</h4>
            <div style="position: relative; width: 100%; height: 320px;">
                <canvas id="penjualanChart"></canvas>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Konfigurasi Global Font (Premium Plus Jakarta Sans)
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
    Chart.defaults.color = '#94A3B8'; // Warna abu-abu elegan untuk teks grafik

    // 1. GRAFIK PRODUK TERLARIS (MENYAMPING - HORIZONTAL BAR)
    const ctxProduk = document.getElementById('produkChart').getContext('2d');
    new Chart(ctxProduk, {
        type: 'bar',
        data: {
            labels: {!! json_encode($namaProduk) !!},
            datasets: [{
                label: ' Terjual',
                data: {!! json_encode($jumlahProduk) !!},
                backgroundColor: '#6366F1', // Warna Indigo Modern
                hoverBackgroundColor: '#4F46E5',
                borderRadius: 100, // Ujung bar bulat sempurna (Khas UI Vercel/Apple)
                borderSkipped: false,
                barThickness: 14 // Dibuat ramping dan profesional
            }]
        },
        options: {
            indexAxis: 'y', // MEMBUAT DIAGRAM MENYAMPING
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { 
                    backgroundColor: '#0F172A', titleFont: { size: 13, weight: '700' }, 
                    bodyFont: { size: 13, weight: '500' }, padding: 12, cornerRadius: 8, displayColors: false
                }
            },
            scales: {
                x: {
                    grid: { display: false, drawBorder: false }, // Hilangkan grid kaku
                    ticks: { font: { weight: '600' } },
                    border: { display: false }
                },
                y: {
                    grid: { display: false, drawBorder: false },
                    ticks: { font: { weight: '600', color: '#334155' } },
                    border: { display: false }
                }
            }
        }
    });

    // 2. GRAFIK PENJUALAN HARIAN (LINE CHART PREMIUM)
    const ctxPenjualan = document.getElementById('penjualanChart').getContext('2d');
    
    // Gradasi super lembut di bawah garis
    let gradientFill = ctxPenjualan.createLinearGradient(0, 0, 0, 300);
    gradientFill.addColorStop(0, 'rgba(16, 185, 129, 0.25)'); // Emerald muda
    gradientFill.addColorStop(1, 'rgba(16, 185, 129, 0.0)');  // Memudar transparan

    new Chart(ctxPenjualan, {
        type: 'line',
        data: {
            labels: {!! json_encode($tanggalPenjualan) !!},
            datasets: [{
                label: ' Omset Rp',
                data: {!! json_encode($totalPenjualanHarian) !!},
                borderColor: '#10B981', // Emerald Solid
                backgroundColor: gradientFill,
                borderWidth: 3, // Garis ditebalkan sedikit agar menonjol
                tension: 0.4, // Kurva bezier yang sangat halus
                fill: true,
                pointRadius: 0, // Titik hilang saat diam,
                pointHoverRadius: 6, // Namun muncul elegan saat di-hover
                pointBackgroundColor: '#FFFFFF',
                pointBorderColor: '#10B981',
                pointBorderWidth: 2,
                pointHitRadius: 20 // Area sensitif kursor diperbesar
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { 
                    backgroundColor: '#0F172A', titleFont: { size: 13, weight: '700' }, 
                    bodyFont: { size: 13, weight: '500' }, padding: 12, cornerRadius: 8, displayColors: false
                }
            },
            scales: {
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: { font: { weight: '500' }, maxTicksLimit: 7 }, // Jangan terlalu padat
                    border: { display: false }
                },
                y: {
                    grid: { color: '#F1F5F9', borderDash: [4, 4], drawBorder: false }, // Grid putus-putus tipis yang elegan
                    beginAtZero: true,
                    border: { display: false },
                    ticks: {
                        font: { weight: '600' },
                        callback: function(value) {
                            if (value === 0) return 0;
                            return 'Rp ' + (value/1000) + 'k'; // Format K (Ribuan) agar tidak sumpek
                        }
                    }
                }
            }
        }
    });
</script>

@endsection