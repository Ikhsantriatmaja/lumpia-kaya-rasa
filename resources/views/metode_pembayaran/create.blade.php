@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-success text-white">

            <h3 class="mb-0">

                Tambah Metode Pembayaran

            </h3>

        </div>

        <div class="card-body">

            <form action="{{ route('metode-pembayaran.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">

                    <label class="form-label">

                        Nama Metode

                    </label>

                    <input
                        type="text"
                        name="nama_metode"
                        class="form-control"
                        value="QRIS"
                        readonly>

                    <small class="text-muted">

                        Saat ini sistem hanya menggunakan QRIS.

                    </small>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Upload Gambar QRIS

                    </label>

                    <input
                        type="file"
                        name="qris"
                        class="form-control"
                        accept="image/*"
                        required>

                    <small class="text-muted">

                        Format: JPG, JPEG atau PNG.

                    </small>

                </div>

                <div class="d-flex justify-content-between">

                    <a href="{{ route('metode-pembayaran.index') }}"
                       class="btn btn-secondary">

                        Kembali

                    </a>

                    <button
                        type="submit"
                        class="btn btn-success">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection