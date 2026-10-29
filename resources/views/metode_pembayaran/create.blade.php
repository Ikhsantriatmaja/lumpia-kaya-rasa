
@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Tambah Metode Pembayaran</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('metode-pembayaran.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Metode Pembayaran</label>

                    <input
                        type="text"
                        name="nama_metode"
                        class="form-control"
                        placeholder="Contoh: QRIS, DANA, OVO, Transfer Bank"
                        value="{{ old('nama_metode') }}"
                        required>

                    @error('nama_metode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Upload Gambar QRIS 
                    </label>

                    <input
                        type="file"
                        name="qris"
                        class="form-control"
                        accept="image/*">

                    <small class="text-muted">
                        Upload gambar jika metode pembayaran membutuhkan
                        gambar QR atau instruksi pembayaran.
                    </small>

                    @error('qris')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('metode-pembayaran.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-success">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
