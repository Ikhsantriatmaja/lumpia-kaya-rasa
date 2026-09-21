@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">

<style>
    .premium-index-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #2D3748;
        background-color: #F7FAFC;
    }
    .custom-card {
        background: #FFFFFF;
        border-radius: 16px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    }
    .custom-input {
        border-radius: 10px;
        padding: 10px 14px;
        height: 44px;
        font-size: 14px;
        border: 1px solid #E2E8F0;
        transition: all 0.2s;
    }
    .custom-input:focus {
        border-color: #C69656;
        box-shadow: 0 0 0 3px rgba(198, 150, 86, 0.15);
        outline: none;
    }
    
    /* Mini Status Indicator Cards */
    .mini-stat-card {
        background: #FFFFFF;
        border: 1px solid #EDF2F7;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 10px rgba(0,0,0,0.01);
    }

    .modern-table th {
        background: #F8FAFC !important;
        color: #718096 !important;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 16px 20px !important;
        border-bottom: 2px solid #E2E8F0 !important;
    }
    .modern-table td {
        padding: 16px 20px !important;
        font-size: 13.5px;
        border-bottom: 1px solid #EDF2F7;
    }
    .modern-table tbody tr:hover {
        background-color: #F8FAFC;
    }
    
    .btn-gold {
        background: #C69656;
        color: white;
        font-weight: 600;
        border-radius: 10px;
        height: 44px;
        transition: all 0.2s;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-gold:hover {
        background: #B08243;
        color: white;
    }
    .btn-secondary-custom {
        background: #EDF2F7;
        color: #4A5568;
        font-weight: 600;
        border-radius: 10px;
        height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        border: none;
    }
    .btn-secondary-custom:hover {
        background: #E2E8F0;
        color: #2D3748;
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

<div class="container-fluid premium-index-wrapper py-2">

    <div class="d-flex justify-content-between align-items-center mb-4">

    <div>

            <h2 class="fw-bold mb-1"
                style="color:#1A202C;letter-spacing:-0.5px;">

                Daftar Pesanan

            </h2>

            <p class="text-muted mb-0"
            style="font-size:14px;">

                Kelola seluruh pesanan pelanggan Lumpia Kaya Rasa secara real-time

            </p>

        </div>

        <a href="{{ route('pesanan.create') }}"
        class="btn btn-gold px-4">

            + Tambah Pesanan Offline

        </a>

    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="mini-stat-card" style="border-left: 4px solid #4A5568;">
                <div>
                    <span class="small text-muted d-block fw-medium">Total Pesanan</span>
                    <h4 class="fw-bold mb-0 mt-1" style="color: #1A202C;">{{ $totalPesanan ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="mini-stat-card" style="border-left: 4px solid #D69E2E;">
                <div>
                    <span class="small text-muted d-block fw-medium">Status Pending</span>
                    <h4 class="fw-bold mb-0 mt-1" style="color: #D69E2E;">{{ $pending ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="mini-stat-card" style="border-left: 4px solid #3182CE;">
                <div>
                    <span class="small text-muted d-block fw-medium">Sedang Diproses</span>
                    <h4 class="fw-bold mb-0 mt-1" style="color: #3182CE;">{{ $diproses ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="mini-stat-card" style="border-left: 4px solid #38A169;">
                <div>
                    <span class="small text-muted d-block fw-medium">Transaksi Selesai</span>
                    <h4 class="fw-bold mb-0 mt-1" style="color: #38A169;">{{ $selesai ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 custom-card">
        <div class="card-body p-4">

            <form method="GET" action="{{ route('pesanan.index') }}" class="mb-4">
                <div class="row g-3 align-items-end">
                    
                    <div class="col-md-5">
                        <label class="form-label small fw-semibold text-muted mb-2">Cari Pelanggan</label>
                        <input
                            type="text"
                            name="search"
                            value="{{ $search ?? '' }}"
                            class="form-control custom-input"
                            placeholder="Ketik nama atau email pelanggan...">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-semibold text-muted mb-2">Periode Waktu</label>
                        <select name="filter_waktu" class="form-select custom-input">
                            <option value="">Semua Waktu</option>
                            <option value="minggu_ini" {{ (isset($filter_waktu) && $filter_waktu == 'minggu_ini') ? 'selected' : '' }}>Minggu Ini</option>
                            <option value="bulan_ini" {{ (isset($filter_waktu) && $filter_waktu == 'bulan_ini') ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="tahun_ini" {{ (isset($filter_waktu) && $filter_waktu == 'tahun_ini') ? 'selected' : '' }}>Tahun Ini</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-gold w-100">
                            Cari Data
                        </button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('pesanan.index') }}" class="btn btn-secondary-custom w-100">
                            Reset Filter
                        </a>
                    </div>

                </div>
            </form>

            <div class="table-responsive" style="border-radius: 12px; border: 1px solid #E2E8F0;">
                <table class="table table-hover align-middle modern-table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 90px; text-align: center;">ID</th>
                            <th>Identitas Pelanggan</th>
                            <th style="width: 140px;">Tanggal Masuk</th>
                            <th style="width: 150px;">Metode</th>
                            <th style="width: 160px; text-align: center;">Bukti Transfer</th>
                            <th style="width: 130px; text-align: center;">Status Pesanan</th>
                            <th style="width: 150px; text-align: right;">Total Nilai</th>
                            <th style="width: 100px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesanan as $p)
                        <tr>
                            <td class="text-center font-variant-numeric"
                                style="font-weight:700;color:#A0AEC0;">

                                {{ $pesanan->firstItem() + $loop->index }}

                            </td>

                            <td>
                                <div class="fw-semibold text-dark" style="font-size: 14px;">
                                    {{ $p->pelanggan->nama ?? '-' }}
                                </div>
                                <div class="text-muted" style="font-size: 12px; margin-top: 1px;">
                                    {{ $p->pelanggan->email ?? '-' }}
                                </div>
                            </td>

                            <td class="text-muted" style="font-weight: 500;">
                                {{ \Carbon\Carbon::parse($p->tanggal_pesanan)->format('d M Y') }}
                            </td>

                            <td class="text-secondary fw-semibold" style="font-size: 13px;">
                                {{ $p->pembayaran->metodePembayaran->nama_metode ?? '-' }}
                            </td>

                            <td class="text-center">
                                @if(isset($p->pembayaran->bukti_pembayaran) && $p->pembayaran->bukti_pembayaran)
                                    <a href="{{ asset('storage/'.$p->pembayaran->bukti_pembayaran) }}"
                                       target="_blank"
                                       class="btn btn-sm fw-bold px-3"
                                       style="background: #E8F5E9; color: #1B5E20; border-radius: 6px; font-size: 12px; border: 1px solid #C8E6C9; text-decoration: none;">
                                        Lihat Bukti ↗
                                    </a>
                                @else
                                    <span class="badge bg-light text-muted border px-2.5 py-1.5" style="border-radius: 6px; font-weight: 500;">
                                        Belum Diupload
                                    </span>
                                @endif
                            </td>

                            <td class="text-center">
                                @php
                                    $status = strtolower($p->status_pesanan);
                                    $bgColor = '#FEE2E2'; $color = '#991B1B'; // Default Gagal / Batal
                                    if($status == 'pending') { $bgColor = '#FEF3C7'; $color = '#92400E'; }
                                    elseif($status == 'diproses') { $bgColor = '#EBF8FF'; $color = '#2B6CB0'; }
                                    elseif($status == 'selesai') { $bgColor = '#D1FAE5'; $color = '#065F46'; }
                                @endphp
                                <span style="background: {{ $bgColor }}; color: {{ $color }}; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; display: inline-block; min-width: 85px; text-align: center;">
                                    {{ ucfirst($p->status_pesanan) }}
                                </span>
                            </td>

                            <td class="text-end fw-bold text-dark font-variant-numeric" style="font-size: 14px;">
                                Rp {{ number_format($p->total_harga,0,',','.') }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('pesanan.show',$p->id_pesanan) }}"
                                   class="btn btn-sm btn-dark px-3 fw-medium"
                                   style="border-radius: 6px; font-size: 12px; height: 32px; display: inline-flex; align-items: center;">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted font-medium" style="font-size: 14px;">
                                Tidak ada rekaman data pesanan yang sesuai dengan kriteria filter.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            </div>

            @if($pesanan->hasPages())

            <div
            style="
            display:flex;
            justify-content:center;
            margin-top:25px;
            ">

                {{ $pesanan->links() }}

            </div>

            @endif

        </div>
    </div>

</div>

@endsection