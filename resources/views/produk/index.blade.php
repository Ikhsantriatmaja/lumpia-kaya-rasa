@extends('layouts.admin')

@section('content')

<style>
    /* DESIGN SYSTEM - PREMIUM BLACK & GOLD */
    :root { --gold: #C69656; --dark: #1a1a1a; --soft-bg: #f8fafc; }
    .pro-dashboard { font-family: 'Plus Jakarta Sans', sans-serif; }
    
    /* Stats Card */
    .stat-card { background: #fff; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; display: flex; align-items: center; transition: 0.3s; }
    .icon-box { width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 15px; background: #fffaf0; color: var(--gold); border: 1px solid #fef3c7; }
    
    /* Table Styling */
    .table-container { background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; }
    .table thead { background: var(--dark); color: #fff; }
    .table th { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; padding: 14px !important; }
    .table td { padding: 14px !important; vertical-align: middle; }
    
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

    /* Luxury Buttons */
    .btn-gold { background: var(--gold); color: white; padding: 8px 20px; border-radius: 8px; font-weight: 600; border: none; }
    .btn-gold:hover { background: #a67b40; color: white; }
    .badge-stock { background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; font-weight: 700; }
</style>

<div class="pro-dashboard">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--dark);">Daftar Produk</h2>
            <p class="text-muted small m-0">Pengelolaan katalog menu Lumpia Kaya Rasa</p>
        </div>
        <a href="{{ route('produk.create') }}" class="btn btn-gold shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="icon-box"><i class="bi bi-box-seam"></i></div>
                <div><h6 class="text-muted small text-uppercase fw-bold mb-0">Total Produk</h6><h4 class="fw-bold m-0">{{ $totalProduk }}</h4></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="icon-box"><i class="bi bi-calendar-event"></i></div>
                <div><h6 class="text-muted small text-uppercase fw-bold mb-0">Bulan Ini</h6><h4 class="fw-bold m-0">{{ $produkBulanIni }}</h4></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="icon-box"><i class="bi bi-graph-up-arrow"></i></div>
                <div><h6 class="text-muted small text-uppercase fw-bold mb-0">Tahun Ini</h6><h4 class="fw-bold m-0">{{ $produkTahunIni }}</h4></div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <form method="GET" action="{{ route('produk.index') }}" class="d-flex" style="max-width: 320px;">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama produk..." class="form-control rounded-start-pill ps-3">
            <button type="submit" class="btn btn-dark rounded-end-pill px-4">Cari</button>
        </form>
    </div>

    <div class="table-container shadow-sm">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produk as $p)
                <tr>
                    <td class="text-center text-muted fw-bold">{{ ($produk->currentPage() - 1) * $produk->perPage() + $loop->iteration }}</td>
                    <td>
                        @if($p->gambar)
                            <img src="{{ asset('storage/'.$p->gambar) }}" class="rounded shadow-sm" style="width: 45px; height: 45px; object-fit: cover; border: 2px solid var(--gold);">
                        @else
                            <div class="bg-light rounded text-center d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; font-size: 10px; border: 1px solid #ddd;">N/A</div>
                        @endif
                    </td>
                    <td class="fw-bold text-dark">{{ $p->nama_produk }}</td>
                    <td class="text-muted small">{{ \Illuminate\Support\Str::limit($p->deskripsi, 40) }}</td>
                    <td class="fw-bold" style="color: var(--gold);">Rp {{ number_format($p->harga,0,',','.') }}</td>
                    <td>
                        @if($p->stok > 0)
                            <span class="badge badge-stock">{{ $p->stok }}</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('produk.edit', $p->id_produk) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            <form action="{{ route('produk.destroy', $p->id_produk) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-5 text-muted">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $produk->links() }}
    </div>
</div>
@endsection