@extends('layouts.admin')

@section('content')

<div style="
    background:white;
    padding:25px;
    border-radius:10px;
">

    <!-- HEADER -->
    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    ">

        <h2>Data Pelanggan</h2>

        <a href="{{ route('pelanggan.create') }}"
           class="btn btn-dark">

            + Tambah Pelanggan

        </a>

    </div>

    <!-- ALERT -->
    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <!-- SEARCH -->
    <form method="GET"
          action="{{ route('pelanggan.index') }}"
          style="
            margin-bottom:20px;
            display:flex;
            gap:10px;
          ">

        <input type="text"
               name="search"
               value="{{ $search ?? '' }}"
               placeholder="Cari pelanggan..."
               class="form-control">

        <button type="submit"
                class="btn btn-dark">

            Cari

        </button>

    </form>

    <!-- TABLE -->
    <table width="100%"
           cellpadding="12"
           style="border-collapse:collapse;">

        <tr style="
            background:#212529;
            color:white;
        ">

            <th width="60"
                style="text-align:center;">
                No
            </th>

            <th>Nama</th>

            <th>Email</th>

            <th>Alamat</th>

            <th>No HP</th>

            <th width="180"
                style="text-align:center;">
                Aksi
            </th>

        </tr>

        @forelse ($pelanggan as $p)

        <tr style="
            border-bottom:1px solid #ddd;
        ">

            <td style="
                text-align:center;
                vertical-align:middle;
            ">

                {{ ($pelanggan->currentPage() - 1) * $pelanggan->perPage() + $loop->iteration }}

            </td>

            <td>{{ $p->nama }}</td>

            <td>{{ $p->email }}</td>

            <td>{{ $p->alamat }}</td>

            <td>{{ $p->no_hp }}</td>

            <td style="text-align:center;">

                <div style="
                    display:flex;
                    justify-content:center;
                    gap:10px;
                ">

                    <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}"
                       class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus pelanggan?')">

                            Hapus

                        </button>

                    </form>

                </div>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="6"
                style="
                    text-align:center;
                    padding:20px;
                ">

                Data pelanggan tidak ditemukan

            </td>

        </tr>

        @endforelse

    </table>

    <!-- PAGINATION -->
    @if ($pelanggan->hasPages())

    <div style="
        margin-top:30px;
        display:flex;
        justify-content:center;
        align-items:center;
        gap:8px;
    ">

        @if ($pelanggan->onFirstPage())

            <span class="btn btn-secondary btn-sm disabled">
                ←
            </span>

        @else

            <a href="{{ $pelanggan->previousPageUrl() }}"
               class="btn btn-outline-dark btn-sm">

                ←

            </a>

        @endif

        @for ($i = 1; $i <= $pelanggan->lastPage(); $i++)

            @if ($i == $pelanggan->currentPage())

                <span class="btn btn-dark btn-sm">

                    {{ $i }}

                </span>

            @else

                <a href="{{ $pelanggan->url($i) }}"
                   class="btn btn-outline-dark btn-sm">

                    {{ $i }}

                </a>

            @endif

        @endfor

        @if ($pelanggan->hasMorePages())

            <a href="{{ $pelanggan->nextPageUrl() }}"
               class="btn btn-outline-dark btn-sm">

                →

            </a>

        @else

            <span class="btn btn-secondary btn-sm disabled">
                →
            </span>

        @endif

    </div>

    @endif

</div>

@endsection