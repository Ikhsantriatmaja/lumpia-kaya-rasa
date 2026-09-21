@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-success text-white">

            <h3 class="mb-0">

                Tambah Pesanan Offline

            </h3>

        </div>

        <div class="card-body">

            <form action="{{ route('pesanan.store') }}" method="POST">

                @csrf

                {{-- ========================= --}}
                {{-- JENIS PELANGGAN --}}
                {{-- ========================= --}}

                <div class="mb-4">

                    <label class="form-label fw-bold">

                        Jenis Pelanggan

                    </label>

                    <div>

                        <div class="form-check form-check-inline">

                            <input
                                class="form-check-input"
                                type="radio"
                                name="jenis_pelanggan"
                                id="lama"
                                value="lama"
                                checked>

                            <label
                                class="form-check-label"
                                for="lama">

                                Pelanggan Lama

                            </label>

                        </div>

                        <div class="form-check form-check-inline">

                            <input
                                class="form-check-input"
                                type="radio"
                                name="jenis_pelanggan"
                                id="baru"
                                value="baru">

                            <label
                                class="form-check-label"
                                for="baru">

                                Pelanggan Baru

                            </label>

                        </div>

                    </div>

                </div>

                {{-- ========================= --}}
                {{-- PELANGGAN LAMA --}}
                {{-- ========================= --}}

                <div id="pelangganLama">

                    <div class="mb-3">

                        <label class="form-label">

                            Pilih Pelanggan

                        </label>

                        <select
                            name="id_pelanggan"
                            class="form-control">

                            <option value="">

                                -- Pilih Pelanggan --

                            </option>

                            @foreach($pelanggan as $pl)

                                <option value="{{ $pl->id_pelanggan }}">

                                    {{ $pl->nama }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                {{-- ========================= --}}
                {{-- PELANGGAN BARU --}}
                {{-- ========================= --}}

                <div
                    id="pelangganBaru"
                    style="display:none;">

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Pelanggan

                        </label>

                        <input
                            type="text"
                            name="nama_baru"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email_baru"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            No HP

                        </label>

                        <input
                            type="text"
                            name="no_hp_baru"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Alamat

                        </label>

                        <textarea
                            name="alamat_baru"
                            class="form-control"
                            rows="3"></textarea>

                    </div>

                </div>

                {{-- ========================= --}}
                {{-- PRODUK --}}
                {{-- ========================= --}}

                <div class="mb-3">

                    <label class="form-label">

                        Produk

                    </label>

                    <select
                        name="id_produk"
                        class="form-control"
                        required>

                        <option value="">

                            -- Pilih Produk --

                        </option>

                        @foreach($produk as $pr)

                            <option
                                value="{{ $pr->id_produk }}">

                                {{ $pr->nama_produk }}
                                -
                                Rp {{ number_format($pr->harga,0,',','.') }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- ========================= --}}
                {{-- JUMLAH --}}
                {{-- ========================= --}}

                <div class="mb-3">

                    <label class="form-label">

                        Jumlah

                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        min="1"
                        class="form-control"
                        required>

                </div>

                {{-- ========================= --}}
                {{-- METODE PEMBAYARAN --}}
                {{-- ========================= --}}

                <div class="mb-4">

                    <label class="form-label">

                        Metode Pembayaran

                    </label>

                    <select
                        name="id_metode_pembayaran"
                        class="form-control"
                        required>

                        @foreach($metodePembayaran as $m)

                            <option
                                value="{{ $m->id_metode_pembayaran }}"
                                {{ strtolower($m->nama_metode) == 'cash' ? 'selected' : '' }}>

                                {{ $m->nama_metode }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="d-flex justify-content-between">

                    <a
                        href="{{ route('pesanan.index') }}"
                        class="btn btn-secondary">

                        Kembali

                    </a>

                    <button
                        type="submit"
                        class="btn btn-success">

                        Simpan Pesanan Offline

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function(){

    const radio = document.querySelectorAll(
        'input[name="jenis_pelanggan"]'
    );

    const lama = document.getElementById(
        "pelangganLama"
    );

    const baru = document.getElementById(
        "pelangganBaru"
    );

    radio.forEach(function(item){

        item.addEventListener("change", function(){

            if(this.value === "baru"){

                lama.style.display = "none";

                baru.style.display = "block";

            }else{

                lama.style.display = "block";

                baru.style.display = "none";

            }

        });

    });

});

</script>

@endsection