@extends('layouts.admin')

@section('content')

<style>
    /* DESIGN SYSTEM - PREMIUM BLACK & GOLD (KONSISTEN) */
    :root { 
        --gold: #C69656; 
        --dark: #1a1a1a; 
        --text-main: #0F172A; 
        --text-muted: #64748B; 
    }
    .pro-dashboard { font-family: 'Plus Jakarta Sans', sans-serif; }

    /* Header Styling */
    .page-head h2 { font-weight: 800; color: var(--text-main); letter-spacing: -0.02em; }
    .page-head p { color: var(--text-muted); font-size: 0.95rem; font-weight: 500; }

    /* Table Styling Modern & Bersih */
    .table-container { 
        background: #fff; 
        border-radius: 16px; 
        border: 1px solid #E2E8F0; 
        overflow: hidden; 
        box-shadow: 0 4px 20px rgba(0,0,0,0.03); 
    }
    .table thead { background: var(--dark); color: #fff; }
    .table th { 
        font-size: 0.75rem; 
        text-transform: uppercase; 
        letter-spacing: 0.1em; 
        padding: 20px !important; 
        font-weight: 700;
    }
    .table td { 
        padding: 20px !important; 
        color: var(--text-main); 
        font-weight: 600; 
        vertical-align: middle; 
        font-size: 0.95rem; 
        border-bottom: 1px solid #F1F5F9; 
    }
    
    /* Buttons Luxury */
    .btn-gold { 
        background: var(--gold); 
        color: white; 
        padding: 12px 24px; 
        border-radius: 12px; 
        font-weight: 700; 
        border: none; 
        transition: 0.3s; 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
    }
    .btn-gold:hover { background: #a67b40; color: white; transform: translateY(-2px); }
    
    .btn-action { 
        padding: 8px 16px; 
        border-radius: 10px; 
        font-size: 0.85rem; 
        font-weight: 700; 
        text-decoration: none; 
        display: inline-flex; 
        align-items: center; 
        gap: 6px; 
        transition: 0.2s;
    }
    .btn-edit { border: 1.5px solid var(--gold); color: var(--gold); background: #FFFDF4; }
    .btn-edit:hover { background: var(--gold); color: #fff; }
    
    .btn-del { background: #FEF2F2; color: #DC2626; border: 1.5px solid #FEE2E2; }
    .btn-del:hover { background: #DC2626; color: #fff; border-color: #DC2626; }
</style>

<div class="pro-dashboard container py-4">
    <div class="page-head d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Metode Pembayaran</h2>
            <p class="mb-0">Kelola konfigurasi opsi pembayaran yang tersedia untuk pelanggan</p>
        </div>
        <a href="{{ route('metode-pembayaran.create') }}" class="btn btn-gold shadow-sm">
            <i class="bi bi-plus-lg"></i> Tambah Metode
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 py-3 rounded-4 fw-semibold">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="text-center" width="90">No</th>
                    <th>Nama Metode Pembayaran</th>
                    <th class="text-center" width="220">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($metode as $m)
                <tr>
                    <td class="text-center text-muted fw-bold">{{ $loop->iteration }}</td>
                    <td class="text-dark fs-6">{{ $m->nama_metode }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('metode-pembayaran.edit', $m->id_metode_pembayaran) }}" class="btn-action btn-edit">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('metode-pembayaran.destroy', $m->id_metode_pembayaran) }}" method="POST" class="m-0">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-del" onclick="return confirm('Yakin ingin menghapus metode pembayaran ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-5 text-muted fw-medium">Belum ada metode pembayaran yang tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection