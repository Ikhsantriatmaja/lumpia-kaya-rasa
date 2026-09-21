@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-warning">

            <h3 class="mb-0">

                Edit Metode Pembayaran

            </h3>

        </div>

        <div class="card-body">

            <form action="{{ route('metode-pembayaran.update',$metode->id_metode_pembayaran) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">

                        Nama Metode

                    </label>

                    <input
                        type="text"
                        name="nama_metode"
                        class="form-control"
                        value="{{ $metode->nama_metode }}"
                        required>

                </div>


                @if($metode->qris)

                <div class="mb-3">

                    <label class="form-label">

                        QRIS Saat Ini

                    </label>

                    <br>

                    <img
                        src="{{ asset('storage/'.$metode->qris) }}"
                        class="img-thumbnail"
                        style="
                            width:250px;
                            border-radius:12px;
                        ">

                </div>

                @endif


                <div class="mb-3">

                    <label class="form-label">

                        Ganti Gambar QRIS

                    </label>

                    <input
                        type="file"
                        name="qris"
                        class="form-control"
                        accept="image/*">

                    <small class="text-muted">

                        Kosongkan jika tidak ingin mengganti QRIS.

                    </small>

                </div>


                <div class="d-flex justify-content-between">

                    <a
                        href="{{ route('metode-pembayaran.index') }}"
                        class="btn btn-secondary">

                        Kembali

                    </a>

                    <button
                        class="btn btn-success">

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection