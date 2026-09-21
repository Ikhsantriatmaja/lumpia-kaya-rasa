@extends('layouts.admin')

@section('content')

<style>

    :root{
        --gold:#C69656;
        --gold-soft:#FFF8EC;
        --text:#0F172A;
        --muted:#64748B;
    }

    .pro-dashboard{
        font-family:'Plus Jakarta Sans',sans-serif;
    }

    .page-title{
        font-weight:800;
        color:var(--text);
        margin-bottom:5px;
    }

    .page-subtitle{
        color:var(--muted);
        font-size:14px;
    }

    .top-card{

        background:#fff;

        border:1px solid #F1E2C8;

        border-radius:18px;

        padding:25px;

        margin-bottom:25px;

        box-shadow:
            0 4px 20px rgba(0,0,0,.04);
    }

    .top-label{

        color:var(--gold);

        font-size:13px;

        font-weight:700;

        text-transform:uppercase;

        letter-spacing:1px;
    }

    .top-product{

        font-size:28px;

        font-weight:800;

        color:var(--text);

        margin:8px 0;
    }

    .top-score{

        color:#16A34A;

        font-weight:700;
    }

    .table-card{

        background:#fff;

        border-radius:18px;

        border:1px solid #E2E8F0;

        overflow:hidden;

        box-shadow:
            0 4px 20px rgba(0,0,0,.03);
    }

    .table thead{

        background:var(--gold-soft);
    }

    .table th{

        color:#B8860B;

        font-size:12px;

        text-transform:uppercase;

        letter-spacing:1px;

        padding:18px !important;

        font-weight:700;

        border:none;
    }

    .table td{

        padding:18px !important;

        vertical-align:middle;

        border-bottom:1px solid #F1F5F9;

        font-weight:600;

        color:var(--text);
    }

    .table tbody tr:hover{

        background:#FFFCF5;
    }

    .rank{

        width:38px;

        height:38px;

        border-radius:50%;

        background:var(--gold-soft);

        color:var(--gold);

        display:flex;

        align-items:center;

        justify-content:center;

        margin:auto;

        font-weight:800;
    }

    .rating-badge{

        background:#FFF8EC;

        color:#B8860B;

        padding:7px 14px;

        border-radius:10px;

        font-size:13px;

        font-weight:700;
    }

    .nilai-badge{

        background:#DCFCE7;

        color:#15803D;

        border:1px solid #BBF7D0;

        padding:8px 16px;

        border-radius:10px;

        font-size:13px;

        font-weight:700;
    }

</style>

<div class="container py-4 pro-dashboard">

    <div class="mb-4">

        <h2 class="page-title">
            Analisis Produk Unggulan
        </h2>

        <div class="page-subtitle">
            Hasil perhitungan metode Simple Additive Weighting (SAW).
        </div>

    </div>


    @if(count($data))

    <div class="top-card">

        <div class="top-label">

            Produk Terbaik

        </div>

        <div class="top-product">

            🏆 {{ $data[0]['produk']->nama_produk }}

        </div>

        <div>

            Nilai SAW :

            <span class="top-score">

                {{ number_format($data[0]['nilai'],3) }}

            </span>

        </div>

    </div>

    @endif


    <div class="table-card">

        <table class="table mb-0">

            <thead>

                <tr>

                    <th class="text-center" width="100">
                        Ranking
                    </th>

                    <th>
                        Produk
                    </th>

                    <th class="text-center">
                        Penjualan
                    </th>

                    <th class="text-center">
                        Rating
                    </th>

                    <th class="text-center">
                        Stok
                    </th>

                    <th class="text-center">
                        Nilai SAW
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($data as $d)

                <tr>

                    <td class="text-center">

                        <div class="rank">

                            {{ $loop->iteration }}

                        </div>

                    </td>

                    <td>

                        {{ $d['produk']->nama_produk }}

                    </td>

                    <td class="text-center">

                        {{ $d['penjualan'] }}

                    </td>

                    <td class="text-center">

                        <span class="rating-badge">

                            ⭐ {{ $d['rating'] }}

                        </span>

                    </td>

                    <td class="text-center">

                        {{ $d['stok'] }}

                    </td>

                    <td class="text-center">

                        <span class="nilai-badge">

                            {{ number_format($d['nilai'],3) }}

                        </span>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        class="text-center py-5 text-muted">

                        Belum ada data produk.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection