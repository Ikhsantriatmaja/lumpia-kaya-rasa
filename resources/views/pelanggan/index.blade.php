@extends('layouts.admin')

@section('content')

<style>
    /* DESIGN SYSTEM - PREMIUM BLACK & GOLD */
    :root { --gold: #C69656; --dark: #1a1a1a; }
    .pro-dashboard { font-family: 'Plus Jakarta Sans', sans-serif; }
    
    /* Stats Cards */
    .stat-card { background: #fff; padding: 18px 20px; border-radius: 12px; border: 1px solid #e2e8f0; display: flex; align-items: center; transition: 0.3s; }
    .icon-box { width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 15px; background: #fffaf0; color: var(--gold); border: 1px solid #fef3c7; }
    
    /* Table Styling */
    .table-container { background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; }
    .table thead { background: var(--dark); color: #fff; }
    .table th { font-size: 0.70rem; text-transform: uppercase; letter-spacing: 0.08em; padding: 14px !important; }
    .table td { padding: 12px 14px !important; color: #334155; font-weight: 500; vertical-align: middle; font-size: 0.85rem; }
    
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
    
    /* Buttons */
    .btn-gold { background: var(--gold); color: white; padding: 8px 20px; border-radius: 8px; font-weight: 600; border: none; }
    .btn-gold:hover { background: #a67b40; color: white; }
    .btn-action { padding: 5px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; text-decoration: none; }
    .btn-edit { border: 1px solid var(--gold); color: var(--gold); }
    .btn-edit:hover { background: var(--gold); color: #fff; }
</style>

<div class="pro-dashboard">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--dark);">Data Pelanggan</h2>
            <p class="text-muted small m-0">Basis data pelanggan terdaftar</p>
        </div>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-gold shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Tambah Pelanggan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 py-2 small">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <form method="GET" action="{{ route('pelanggan.index') }}" class="d-flex" style="max-width: 300px;">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari pelanggan..." class="form-control form-control-sm rounded-start-pill ps-3">
            <button type="submit" class="btn btn-dark btn-sm rounded-end-pill px-4">Cari</button>
        </form>
    </div>

    <div class="table-container shadow-sm">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelanggan as $p)
                <tr>
                    <td class="text-center text-muted fw-bold">{{ ($pelanggan->currentPage() - 1) * $pelanggan->perPage() + $loop->iteration }}</td>
                    <td class="fw-bold text-dark">{{ $p->nama }}</td>
                    <td class="text-muted">{{ $p->email }}</td>
                    <td class="text-muted">{{ \Illuminate\Support\Str::limit($p->alamat, 35) }}</td>
                    <td class="text-muted">{{ $p->no_hp }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}" class="btn-action btn-edit">Edit</a>
                            <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action" style="background:#fef2f2; color:#dc2626; border:1px solid #fee2e2;" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-5 text-muted">Belum ada data pelanggan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $pelanggan->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection