@extends('layouts.pelanggan')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1" style="color:#C69656;">
                Pesanan Saya
            </h2>

            <p class="text-muted mb-0">
                Riwayat seluruh pesanan yang pernah Anda lakukan
            </p>
        </div>

    </div>

    @if($pesanan->count() > 0)

        <div class="row">

            @foreach($pesanan as $p)

                <div class="col-lg-6 mb-4">

                    <div style="
                        background:white;
                        border-radius:18px;
                        padding:25px;
                        box-shadow:0 5px 20px rgba(0,0,0,.08);
                        border-left:6px solid #C69656;
                    ">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h5 class="fw-bold mb-0">
                                Pesanan #{{ $p->id_pesanan }}
                            </h5>

                            @if($p->status_pesanan == 'pending')

                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>

                            @elseif($p->status_pesanan == 'diproses')

                                <span class="badge bg-primary">
                                    Diproses
                                </span>

                            @elseif($p->status_pesanan == 'selesai')

                                <span class="badge bg-success">
                                    Selesai
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ $p->status_pesanan }}
                                </span>

                            @endif

                        </div>

                        <hr>

                        <div class="mb-2">
                            <strong>Tanggal Pesanan :</strong>
                            <br>
                            {{ \Carbon\Carbon::parse($p->tanggal_pesanan)->translatedFormat('d F Y') }}
                        </div>

                        <div class="mb-2">
                            <strong>Total Pembayaran :</strong>
                            <br>

                            <span style="
                                color:#198754;
                                font-size:22px;
                                font-weight:bold;
                            ">
                                Rp {{ number_format($p->total_harga,0,',','.') }}
                            </span>

                        </div>

                        <div class="mt-3">

                            <strong>Produk Yang Dipesan :</strong>

                            <ul class="mt-2">

                                @foreach($p->detailPesanan as $detail)

                                    <li class="d-flex justify-content-between align-items-center mb-2">

                                        <div>

                                            {{ $detail->produk->nama_produk ?? '-' }}
                                            ({{ $detail->jumlah }}x)

                                        </div>

                                        @if($p->status_pesanan == 'selesai')

                                            <a
                                                href="{{ url('/?produk='.$detail->id_produk.'&pesanan='.$p->id_pesanan) }}#review"
                                                class="btn btn-sm"
                                                style="
                                                    background:#C69656;
                                                    color:white;
                                                    border-radius:8px;
                                                ">

                                                Beri Review

                                            </a>

                                        @endif

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div style="
            background:white;
            padding:50px;
            text-align:center;
            border-radius:20px;
            box-shadow:0 5px 20px rgba(0,0,0,.08);
        ">

            <h3 style="color:#C69656;">
                Belum Ada Pesanan
            </h3>

            <p class="text-muted">
                Anda belum pernah melakukan pemesanan.
            </p>

            <a
                href="/produk"
                class="btn mt-2"
                style="
                    background:#C69656;
                    color:white;
                    border-radius:10px;
                ">

                Pesan Sekarang

            </a>

        </div>

    @endif

</div>

@endsection