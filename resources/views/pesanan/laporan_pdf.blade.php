<!DOCTYPE html>
<html>
<head>

    <title>Laporan Penjualan</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            font-size:12px;
            color:#000;
        }

        .header{
            text-align:center;
            margin-bottom:20px;
        }

        .header h2{
            margin:0;
        }

        .header p{
            margin:5px 0;
        }

        .info{
            margin-bottom:15px;
            line-height:1.8;
        }

        hr{
            margin:15px 0;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:#d4af37;
            color:black;
            border:1px solid #000;
            padding:8px;
            text-align:center;
        }

        table td{
            border:1px solid #000;
            padding:8px;
        }

        .text-center{
            text-align:center;
        }

        .text-right{
            text-align:right;
        }

        .total{
            margin-top:20px;
            text-align:right;
            font-size:14px;
            font-weight:bold;
        }

        .footer{
            margin-top:40px;
            text-align:right;
            font-size:11px;
            color:#555;
        }

    </style>

</head>

<body>

<div class="header">

    <h2>
        LAPORAN PENJUALAN
    </h2>

    <p>
        <strong>Lumpia Kaya Rasa</strong>
    </p>

</div>

<hr>

<div class="info">

    <strong>Periode :</strong>

    @if($bulan && $tahun)

        Bulan {{ $bulan }} Tahun {{ $tahun }}

    @elseif($bulan)

        Bulan {{ $bulan }}

    @elseif($tahun)

        Tahun {{ $tahun }}

    @else

        Semua Data

    @endif

    <br>

    <strong>Tanggal Cetak :</strong>
    {{ $tanggalCetak->format('d-m-Y H:i') }}

</div>

<table>

    <thead>

        <tr>

            <th width="10%">ID</th>

            <th width="30%">Pelanggan</th>

            <th width="30%">Detail Pesanan</th>

            <th width="20%">Tanggal</th>

            <th width="20%">Total</th>

            <th width="20%">Status</th>

        </tr>

    </thead>

    <tbody>

        @forelse($pesanan as $p)

        <tr>

    <td class="text-center">
        {{ $p->id_pesanan }}
    </td>

    <td>
        {{ $p->pelanggan->nama ?? '-' }}
    </td>

    <td>

        @foreach($p->detailPesanan as $detail)

            • {{ $detail->produk->nama_produk ?? '-' }}
            ({{ $detail->jumlah }})

            <br>

        @endforeach

    </td>

    <td class="text-center">
        {{ date('d-m-Y', strtotime($p->created_at)) }}
    </td>

    <td class="text-right">
        Rp {{ number_format($p->total_harga,0,',','.') }}
    </td>

    <td class="text-center">
        {{ ucfirst($p->status_pesanan) }}
    </td>


        </tr>

        @empty

        <tr>

            <td colspan="5" class="text-center">

                Tidak ada data

            </td>

        </tr>

        @endforelse

    </tbody>

</table>

<div class="total">

    Total Omset :
    Rp {{ number_format($totalOmset,0,',','.') }}

</div>
</body>
</html>
