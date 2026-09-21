@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">

<style>
    /* Scope wrapper utama agar tidak tabrakan dengan CSS global admin */
    .dashboard-premium-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #2D3748;
        background-color: #F7FAFC;
        padding: 15px 10px;
    }

    /* Form & Input Fields */
    .custom-input-group {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        width: 100%;
        height: 46px;
        font-size: 14px;
        font-weight: 500;
        color: #4A5568;
        transition: all 0.2s ease-in-out;
    }
    .custom-input-group:focus {
        border-color: #C5A059;
        box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.15);
        outline: none;
    }

    /* Premium Action Buttons */
    .btn-action-base {
        border-radius: 10px;
        padding: 0 24px;
        height: 46px;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
        border: none;
    }
    .btn-filter-primary { background: #1A202C; color: #FFFFFF; }
    .btn-filter-primary:hover { background: #2D3748; transform: translateY(-1px); }
    
    .btn-reset-secondary { background: #EDF2F7; color: #4A5568; }
    .btn-reset-secondary:hover { background: #E2E8F0; color: #2D3748; }
    
    .btn-export-pdf { background: #10B981; color: #FFFFFF; }
    .btn-export-pdf:hover { background: #059669; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2); }

    /* Cards Component */
    .stat-card-premium {
        background: #FFFFFF;
        border-radius: 16px;
        padding: 26px 30px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
        border: 1px solid #EDF2F7;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .stat-card-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 22px rgba(0, 0, 0, 0.05);
    }

    /* Table Styling */
    .premium-data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .premium-data-table th {
        background: #F8FAFC;
        color: #718096;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 16px 20px;
        border-bottom: 2px solid #E2E8F0;
    }
    .premium-data-table td {
        padding: 18px 20px;
        font-size: 13px;
        color: #4A5568;
        border-bottom: 1px solid #EDF2F7;
        vertical-align: middle;
    }
    .premium-data-table tbody tr:hover {
        background-color: #F8FAFC;
    }

    /* Badge Items Detail Pesanan */
    .product-order-badge {
        background: #F1F5F9;
        color: #334155;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        border: 1px solid #E2E8F0;
        display: inline-flex;
        align-items: center;
        margin-right: 6px;
        margin-bottom: 6px;
    }
    .product-order-badge b {
        color: #B8860B;
        background: #FFFDF4;
        padding: 2px 6px;
        border-radius: 4px;
        margin-left: 6px;
        font-size: 11px;
        border: 1px solid #F9EBD2;
    }

    .pagination{

        gap:8px;
    }

    .page-link{

        border:none !important;

        border-radius:10px !important;

        padding:10px 16px;

        color:#4A5568;

        font-weight:600;

        background:#fff;

        box-shadow:
            0 2px 8px rgba(0,0,0,.05);
    }

    .page-link:hover{

        background:#1A202C;

        color:#C5A059;
    }

    .page-item.active .page-link{

        background:#1A202C !important;

        color:#C5A059 !important;

        border:none;
    }

    .page-item.disabled .page-link{

        background:#EDF2F7;

        color:#A0AEC0;
    }

</style>

<div class="dashboard-premium-wrapper">

    <div style="margin-bottom: 30px;">
        <h2 style="margin: 0; font-weight: 800; font-size: 26px; color: #1A202C; letter-spacing: -0.5px;">
            Laporan Penjualan
        </h2>
        <p style="margin: 5px 0 0 0; font-size: 14px; color: #718096;">
            Pantau ringkasan performa finansial, volume pesanan, dan konversi statistik toko online Anda.
        </p>
    </div>

    <div style="
        background: #FFFFFF;
        padding: 28px;
        border-radius: 16px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
        border: 1px solid #E2E8F0;
    ">
        <h4 style="margin: 0 0 18px 0; font-size: 15px; font-weight: 700; color: #2D3748; display: flex; align-items: center; gap: 8px;">
            <span style="width: 4px; height: 16px; background: #C5A059; display: inline-block; border-radius: 2px;"></span>
            Parameter Penyaringan Data
        </h4>

        <form method="GET" action="{{ route('pesanan.laporan') }}">
            <div style="
                display: flex;
                gap: 20px;
                align-items: flex-end;
                flex-wrap: wrap;
                width: 100%;
            ">
                <div style="flex: 1; min-width: 220px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4A5568;">Bulan Analisis</label>
                    <select name="bulan" class="custom-input-group">
                        <option value="">Semua Bulan</option>
                        @for($i=1;$i<=12;$i++)
                            <option value="{{ $i }}" {{ ($bulan == $i) ? 'selected' : '' }}>
                                {{ date('F', mktime(0,0,0,$i,1)) }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div style="flex: 1; min-width: 220px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4A5568;">Tahun Analisis</label>
                    <select name="tahun" class="custom-input-group">
                        <option value="">Semua Tahun</option>
                        @for($i=date('Y'); $i>=2024; $i--)
                            <option value="{{ $i }}" {{ ($tahun == $i) ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div style="flex: 1.5; min-width: 260px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 13px; color: #4A5568;">Cari Identitas Pelanggan</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" class="custom-input-group" placeholder="Masukkan nama pelanggan...">
                </div>

                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button type="submit" class="btn-action-base btn-filter-primary">
                        Filter Data
                    </button>
                    <a href="{{ route('pesanan.laporan') }}" class="btn-action-base btn-reset-secondary">
                        Reset
                    </a>
                    <a href="{{ route('pesanan.pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="btn-action-base btn-export-pdf">
                        Export PDF
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    ">
        <div class="stat-card-premium" style="border-left: 6px solid #C5A059;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h6 style="margin: 0 0 8px 0; color: #718096; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Total Volume Transaksi</h6>
                    <h2 style="margin: 0; font-size: 34px; font-weight: 800; color: #1A202C; letter-spacing: -1px;">
                        {{ $totalPesanan ?? 0 }}
                    </h2>
                </div>
                <div style="background: #FFFDF4; border: 1px solid #F9EBD2; padding: 10px; border-radius: 12px; color: #C5A059;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <div style="margin-top: 15px; font-size: 12px; color: #A0AEC0; font-weight: 500;">
                Akumulasi seluruh transaksi terekam pada sistem
            </div>
        </div>

        <div class="stat-card-premium" style="background: #FFFDF7; border-left: 6px solid #B8860B; border-color: #F9EBD2 #F9EBD2 #F9EBD2 #B8860B;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <h6 style="margin: 0 0 8px 0; color: #8A6D3B; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Gross Revenue / Total Omset</h6>
                    <h2 style="margin: 0; font-size: 34px; font-weight: 800; color: #B8860B; letter-spacing: -1px;">
                        Rp {{ number_format($totalOmset,0,',','.') }}
                    </h2>
                </div>
                <div style="background: #F4EAD4; padding: 10px; border-radius: 12px; color: #B8860B;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div style="margin-top: 15px; font-size: 12px; color: #8A6D3B; opacity: 0.8; font-weight: 500;">
                Total nilai penjualan kotor sebelum potongan operasional
            </div>
        </div>
    </div>

    <div style="margin-bottom: 15px;">
        <h4 style="margin: 0 0 18px 0; font-size: 15px; font-weight: 700; color: #2D3748; display: flex; align-items: center; gap: 8px;">
            <span style="width: 4px; height: 16px; background: #4A5568; display: inline-block; border-radius: 2px;"></span>
            Breakdown Kinerja Berkala
        </h4>
    </div>

    <div style="
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 35px;
    ">
        <div style="background: #FFFFFF; padding: 24px; border-radius: 14px; box-shadow: 0 4px 12px rgba(0,0,0,0.02); border: 1px solid #E2E8F0;">
            <h5 style="margin: 0 0 16px 0; font-size: 15px; font-weight: 700; color: #2D3748; border-bottom: 2px solid #EDF2F7; padding-bottom: 10px; display: flex; align-items: center; justify-content: space-between;">
                <span>Hari Ini</span>
                <span style="width: 8px; height: 8px; background: #3182CE; border-radius: 50%;"></span>
            </h5>
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 13px;">
                <span style="color: #718096; font-weight: 500;">Pesanan Berjalan</span>
                <span style="font-weight: 700; color: #1A202C;">{{ $pesananHariIni }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 13px;">
                <span style="color: #718096; font-weight: 500;">Omset Terbuku</span>
                <span style="font-weight: 700; color: #10B981;">Rp {{ number_format($omsetHariIni,0,',','.') }}</span>
            </div>
        </div>

        <div style="background: #FFFFFF; padding: 24px; border-radius: 14px; box-shadow: 0 4px 12px rgba(0,0,0,0.02); border: 1px solid #E2E8F0;">
            <h5 style="margin: 0 0 16px 0; font-size: 15px; font-weight: 700; color: #2D3748; border-bottom: 2px solid #EDF2F7; padding-bottom: 10px; display: flex; align-items: center; justify-content: space-between;">
                <span>Minggu Ini</span>
                <span style="width: 8px; height: 8px; background: #805AD5; border-radius: 50%;"></span>
            </h5>
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 13px;">
                <span style="color: #718096; font-weight: 500;">Pesanan Berjalan</span>
                <span style="font-weight: 700; color: #1A202C;">{{ $pesananMingguIni }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 13px;">
                <span style="color: #718096; font-weight: 500;">Omset Terbuku</span>
                <span style="font-weight: 700; color: #10B981;">Rp {{ number_format($omsetMingguIni,0,',','.') }}</span>
            </div>
        </div>

        <div style="background: #FFFFFF; padding: 24px; border-radius: 14px; box-shadow: 0 4px 12px rgba(0,0,0,0.02); border: 1px solid #E2E8F0;">
            <h5 style="margin: 0 0 16px 0; font-size: 15px; font-weight: 700; color: #2D3748; border-bottom: 2px solid #EDF2F7; padding-bottom: 10px; display: flex; align-items: center; justify-content: space-between;">
                <span>Bulan Ini</span>
                <span style="width: 8px; height: 8px; background: #DD6B20; border-radius: 50%;"></span>
            </h5>
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 13px;">
                <span style="color: #718096; font-weight: 500;">Pesanan Berjalan</span>
                <span style="font-weight: 700; color: #1A202C;">{{ $pesananBulanIni }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 13px;">
                <span style="color: #718096; font-weight: 500;">Omset Terbuku</span>
                <span style="font-weight: 700; color: #10B981;">Rp {{ number_format($omsetBulanIni,0,',','.') }}</span>
            </div>
        </div>
    </div>

    <div style="
        background: #FFFFFF;
        padding: 28px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
        border: 1px solid #E2E8F0;
    ">
        <div style="margin-bottom: 22px;">
            <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #1A202C;">
                Riwayat Log Transaksi Masuk
            </h4>
            <p style="margin: 4px 0 0 0; font-size: 12px; color: #A0AEC0;">
                Menampilkan deretan pesanan pelanggan lengkap beserta kuantitas kuantasi produk dan siklus status pemrosesan.
            </p>
        </div>

        <div style="overflow-x: auto; border-radius: 12px; border: 1px solid #E2E8F0;">
            <table class="premium-data-table">
                <thead>
                    <tr>
                        <th style="width: 90px; text-align: center;">NO</th>
                        <th style="width: 220px;">Nama Pelanggan</th>
                        <th>Kuantitas Detail Pesanan</th>
                        <th style="width: 180px;">Waktu & Tanggal</th>
                        <th style="width: 160px; text-align: right;">Total Nilai</th>
                        <th style="width: 140px; text-align: center;">Status Alur</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatPesanan as $pesanan)
                    <tr>
                    <td style="text-align: center; font-weight: 700; color: #A0AEC0;">
                        {{ $riwayatPesanan->firstItem() + $loop->index }}
                    </td>
                        <td style="font-weight: 600; color: #2D3748;">
                            {{ $pesanan->pelanggan->nama ?? '-' }}
                        </td>
                        <td>
                            <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                                @foreach($pesanan->detailPesanan as $detail)
                                    <span class="product-order-badge">
                                        {{ $detail->produk->nama_produk ?? '-' }} 
                                        <b>{{ $detail->jumlah }}x</b>
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td style="color: #718096; font-weight: 500;">
                            {{ $pesanan->created_at->format('d M Y, H:i') }}
                        </td>
                        <td style="font-weight: 700; text-align: right; color: #1A202C; font-variant-numeric: tabular-nums; font-size: 14px;">
                            Rp {{ number_format($pesanan->total_harga,0,',','.') }}
                        </td>
                        <td style="text-align: center;">
                            @php
                                $status = strtolower($pesanan->status_pesanan);
                                $bgColor = '#FEE2E2'; $color = '#991B1B'; // Default Batal / Gagal
                                if($status == 'selesai') { $bgColor = '#D1FAE5'; $color = '#065F46'; }
                                elseif($status == 'diproses') { $bgColor = '#FEF3C7'; $color = '#92400E'; }
                            @endphp
                            <span style="background: {{ $bgColor }}; color: {{ $color }}; padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 700; display: inline-block; min-width: 90px; text-align: center; letter-spacing: 0.3px;">
                                {{ ucfirst($pesanan->status_pesanan) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 50px; color: #A0AEC0; font-size: 14px; font-weight: 500;">
                            Data transaksi kosong atau tidak ditemukan pada parameter ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($riwayatPesanan->hasPages())

        <div
        style="
        margin-top:25px;
        display:flex;
        justify-content:center;
        ">

            {{ $riwayatPesanan->links() }}

        </div>

        @endif

    </div>
</div>

@endsection