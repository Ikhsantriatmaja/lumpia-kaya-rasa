@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">Detail Transaksi</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('pesanan.index') }}" class="text-decoration-none">Daftar Pesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">#{{ $pesanan->id_pesanan }}</li>
        </ol>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4 text-center">
                    <h6 class="text-muted text-uppercase fs-7 fw-semibold mb-2">Total Pembayaran</h6>
                    <h2 class="text-primary fw-bold mb-3">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</h2>
                    
                    @if($pesanan->status_pesanan == 'pending')
                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-semibold">
                            <i class="bi bi-clock me-1"></i> Pending
                        </span>
                    @elseif($pesanan->status_pesanan == 'diproses')
                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill fw-semibold">
                            <i class="bi bi-arrow-repeat me-1"></i> Diproses
                        </span>
                    @elseif($pesanan->status_pesanan == 'selesai')
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold">
                            <i class="bi bi-check-lg me-1"></i> Selesai
                        </span>
                    @else
                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-semibold">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </span>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                    <h5 class="card-title fw-bold m-0 text-dark fs-6">Pembaruan Status</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pesanan.updateStatus', $pesanan->id_pesanan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label text-muted fs-7">Pilih Status Baru</label>
                            <select name="status_pesanan" class="form-select form-select-lg border-2">
                                <option value="pending" {{ $pesanan->status_pesanan == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="diproses" {{ $pesanan->status_pesanan == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ $pesanan->status_pesanan == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ $pesanan->status_pesanan == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-semibold py-2">
                            <i class="bi bi-save me-1"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                    <h5 class="card-title fw-bold m-0 text-dark fs-6">Informasi Pelanggan</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <small class="text-muted d-block">Nama Lengkap</small>
                        <span class="fw-semibold text-dark">{{ $pesanan->pelanggan->nama }}</span>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Email</small>
                        <span class="text-dark">{{ $pesanan->pelanggan->email }}</span>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Nomor HP</small>
                        <span class="text-dark">{{ $pesanan->pelanggan->no_hp ?? '-' }}</span>
                    </div>
                    <div class="mb-0">
                        <small class="text-muted d-block">Tanggal Transaksi</small>
                        <span class="text-dark"> {{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-bold m-0 text-dark fs-5">Rincian Item Produk</h5>
                    <span class="badge bg-secondary px-2 py-1 fs-7 rounded">{{ $pesanan->detailPesanan->count() }} Item</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-muted fs-7 text-uppercase fw-semibold border-top-0">
                                <tr>
                                    <th class="ps-4 py-3">Nama Produk</th>
                                    <th class="text-end py-3">Harga</th>
                                    <th class="text-center py-3">Jumlah</th>
                                    <th class="text-end pe-4 py-3">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan->detailPesanan as $detail)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                                <i class="bi bi-box-seam text-secondary fs-4"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-semibold text-dark fs-6">{{ $detail->produk->nama_produk }}</h6>
                                                <small class="text-muted fs-7">ID: PRD-{{ $detail->id_produk }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end py-3 text-dark">Rp {{ number_format($detail->produk->harga, 0, ',', '.') }}</td>
                                    <td class="text-center py-3">
                                        <span class="badge bg-light text-dark border px-2.5 py-1.5 font-monospace">{{ $detail->jumlah }} Pack</span>
                                    </td>
                                    <td class="text-end pe-4 py-3 fw-bold text-dark">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light fw-bold border-top-2">
                                <tr>
                                    <td colspan="3" class="text-end ps-4 py-3 text-muted">Grand Total:</td>
                                    <td class="text-end pe-4 py-3 text-primary fs-5">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 p-4 pt-0 mt-3">
                    <a href="{{ route('pesanan.index') }}" class="btn btn-light border fw-semibold px-4 py-2">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
    .fs-7 { font-size: 0.85rem !important; }
    .border-2 { border-width: 2px !important; }
</style>
@endsection