@extends('layouts.pelanggan')

@section('content')

<div class="container py-5">
    @if ($errors->any())

    <div class="alert alert-danger mb-4">

        <ul class="mb-0">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif

    <!-- Judul -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">Daftar Produk Lumpia Kaya Rasa</h2>
        <p class="text-muted">
            Pilih produk favoritmu dan lakukan pemesanan dengan mudah
        </p>
    </div>

    <!-- Card Produk -->
    <div class="row">

        @foreach($produk as $p)

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <!-- Gambar Produk -->
                @if($p->gambar)
                    <img src="{{ asset('storage/' . $p->gambar) }}"
                         class="card-img-top"
                         style="height:250px; object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/300x250"
                         class="card-img-top"
                         style="height:250px; object-fit:cover;">
                @endif

                <div class="card-body">

                    <!-- Nama Produk -->
                    <h4 class="fw-bold">
                        {{ $p->nama_produk }}
                    </h4>

                    <!-- Harga -->
                    <h5 class="text-warning fw-bold mb-3">
                        Rp {{ number_format($p->harga,0,',','.') }}
                    </h5>

                    <!-- Stok -->
                    <p>
                        <strong>Stok:</strong>
                        {{ $p->stok }}
                    </p>

                    <!-- Form Checkout -->
                    <form action="{{ route('checkout') }}"
                            method="POST"
                            enctype="multipart/form-data">

                        @csrf

                        <!-- ID Produk -->
                        <input type="hidden"
                               name="id_produk"
                               value="{{ $p->id_produk }}">

                        <!-- Jumlah -->
                        <div class="mb-3">

                            <label class="form-label">
                                Jumlah
                            </label>

                            <input type="number"
                                   name="jumlah"
                                   value="1"
                                   min="1"
                                   class="form-control"
                                   required>

                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="mb-3">

                            <label class="form-label">
                                Metode Pembayaran
                            </label>

                            <select 
                            class="metodePembayaran" 
                            name="id_metode_pembayaran"
                                    class="form-control"
                                    required>

                                <option value="">
                                    -- Pilih Pembayaran --
                                </option>

                                @foreach($metode as $m)

                                    <option
                                        value="{{ $m->id_metode_pembayaran }}"
                                        data-qris="{{ $m->qris ? asset('storage/'.$m->qris) : '' }}">

                                        {{ $m->nama_metode }}

                                    </option>

                                @endforeach

                            </select>

                            <div
                                class="qrisBox"
                                class="mt-4"
                                style="display:none;">

                                <div
                                    class="card border-0 shadow-sm">

                                    <div class="card-body text-center">

                                        <h5
                                            class="fw-bold mb-3"
                                            style="color:#C69656;">

                                            Scan QRIS

                                        </h5>

                                        <img
                                            class="gambarQris"
                                            src=""
                                            class="img-fluid rounded shadow"
                                            style="
                                                max-width:260px;
                                            ">

                                        <p
                                            class="mt-3 text-muted">

                                            Silakan scan menggunakan

                                            <strong>

                                                Dana

                                            </strong>,

                                            <strong>

                                                OVO

                                            </strong>,

                                            <strong>

                                                GoPay

                                            </strong>,

                                            <strong>

                                                ShopeePay

                                            </strong>

                                            atau Mobile Banking.

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Tombol -->
                        <div class="mb-3">
                                <label class="form-label">
                                    Upload Bukti Transfer
                                </label>

                                <input type="file"
                                    name="bukti_pembayaran"
                                    class="form-control"
                                    accept="image/*,.pdf"
                                    required>
                        </div>
                    
                        <button type="submit"
                                class="btn btn-dark w-100">

                            Pesan Sekarang

                        </button>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@push('scripts')


<script>

document
.querySelectorAll('.metodePembayaran')
.forEach(function(select){

    select.addEventListener('change',function(){

        const card =
            this.closest('.card-body');

        const box =
            card.querySelector('.qrisBox');

        const gambar =
            card.querySelector('.gambarQris');

        let option =
            this.options[this.selectedIndex];

        let qris =
            option.dataset.qris;

        if(qris){

            gambar.src = qris;

            box.style.display = 'block';

        }else{

            gambar.src = '';

            box.style.display = 'none';

        }

    });

});

</script>

@endpush


@endsection