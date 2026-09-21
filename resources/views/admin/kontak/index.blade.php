@extends('layouts.admin')

@section('content')

<style>
    /* DESIGN SYSTEM - PREMIUM BLACK & GOLD */
    :root { --gold: #C69656; --dark: #1a1a1a; }
    .pro-dashboard { font-family: 'Plus Jakarta Sans', sans-serif; }
    
    /* Review Card Component */
    .card-review { background: #fff; padding: 25px; border-radius: 16px; border: 1px solid #e2e8f0; margin-bottom: 25px; transition: 0.3s; }
    .card-review:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
    
    /* Product Image Styling */
    .prod-img { width: 100%; height: 200px; object-fit: cover; border-radius: 12px; border: 2px solid #f1f5f9; }
    
    /* Rating Stars */
    .stars { color: #f59e0b; font-size: 1.2rem; margin-bottom: 10px; }
    
    /* Premium Buttons */
    .btn-gold { background: var(--gold); color: white; padding: 10px 24px; border-radius: 8px; font-weight: 600; border: none; width: 100%; transition: 0.3s; }
    .btn-gold:hover { background: #a67b40; color: white; }
    
    /* Status Badges */
    .status-badge { padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; }
    
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

<div class="pro-dashboard">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--dark);">Penilaian Produk</h2>
            <p class="text-muted small m-0">Tinjau dan balas review pelanggan Anda</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
    @endif

    @forelse($kontak as $k)
    <div class="card-review shadow-sm">
        <div class="row">
            {{-- FOTO PRODUK --}}
            <div class="col-md-3">
                @if($k->foto_produk)
                    <img src="{{ asset('storage/'.$k->foto_produk) }}" class="prod-img">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center h-100 text-muted small border">No Image</div>
                @endif
            </div>

            {{-- DETAIL REVIEW --}}
            <div class="col-md-6 border-end px-md-4">
                <h5 class="fw-bold text-dark">{{ $k->produk->nama_produk ?? 'Produk Dihapus' }}</h5>
                <div class="stars">{{ str_repeat('★',$k->rating) }}</div>
                <p class="text-muted" style="font-size: 0.95rem;">"{{ $k->pesan }}"</p>
                <hr>
                <div class="d-flex flex-column">
                    <span class="fw-bold text-dark">{{ $k->nama }}</span>
                    <small class="text-muted">{{ $k->email }}</small>
                    <small class="text-muted mt-1"><i class="bi bi-clock me-1"></i> {{ $k->created_at->format('d-m-Y H:i') }}</small>
                </div>
            </div>

            {{-- BALASAN ADMIN --}}
            <div class="col-md-3">
                <form action="{{ route('kontak.balas', $k->id) }}" method="POST">
                    @csrf 
                    @method('PUT')
                    <label class="fw-bold small mb-2 text-dark">Balasan Admin</label>
                    <textarea name="balasan_admin" class="form-control border-0 bg-light mb-2" rows="4">{{ $k->balasan_admin }}</textarea>
                    <button type="submit" class="btn btn-gold shadow-sm">
                        <i class="bi bi-send me-1"></i> Simpan Balasan
                    </button>
                </form>

                <div class="mt-3">
                    @if($k->balasan_admin)
                        <span class="badge status-badge bg-success"><i class="bi bi-check-circle me-1"></i> Sudah Dibalas</span>
                    @else
                        <span class="badge status-badge bg-warning text-dark"><i class="bi bi-clock-history me-1"></i> Menunggu</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-5">
        <p class="text-muted">Belum ada Review yang masuk.</p>
    </div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $kontak->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection