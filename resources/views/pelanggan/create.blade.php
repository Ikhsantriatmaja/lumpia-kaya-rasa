@extends('layouts.admin')

@section('content')

<div style="
    background:white;
    padding:30px;
    border-radius:10px;
    max-width:600px;
">

    <!-- HEADER -->
    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    ">

        <h2>
            Tambah Pelanggan
        </h2>

        <a href="{{ route('pelanggan.index') }}"
           class="btn btn-secondary">

            Kembali

        </a>

    </div>

    <!-- ERROR -->
    @if ($errors->any())

        <div class="alert alert-danger">

            <ul style="margin-bottom:0;">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- FORM -->
    <form action="{{ route('pelanggan.store') }}"
          method="POST">

        @csrf

        <!-- NAMA -->
        <div style="margin-bottom:20px;">

            <label style="
                font-weight:bold;
                margin-bottom:8px;
                display:block;
            ">
                Nama
            </label>

            <input type="text"
                   name="nama"
                   class="form-control"
                   placeholder="Masukkan nama pelanggan"
                   required>

        </div>

        <!-- EMAIL -->
        <div style="margin-bottom:20px;">

            <label style="
                font-weight:bold;
                margin-bottom:8px;
                display:block;
            ">
                Email
            </label>

            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="Masukkan email"
                   required>

        </div>

        <!-- PASSWORD -->
        <div style="margin-bottom:20px;">

            <label style="
                font-weight:bold;
                margin-bottom:8px;
                display:block;
            ">
                Password
            </label>

            <input type="password"
                   name="password"
                   minlength="6"
                   class="form-control"
                   placeholder="Masukkan password"
                   required>

        </div>

        <!-- ALAMAT -->
        <div style="margin-bottom:20px;">

            <label style="
                font-weight:bold;
                margin-bottom:8px;
                display:block;
            ">
                Alamat
            </label>

            <input type="text"
                   name="alamat"
                   class="form-control"
                   placeholder="Masukkan alamat"
                   required>

        </div>

        <!-- NO HP -->
        <div style="margin-bottom:25px;">

            <label style="
                font-weight:bold;
                margin-bottom:8px;
                display:block;
            ">
                No HP
            </label>

            <input type="text"
                   name="no_hp"
                   minlength="10"
                   class="form-control"
                   placeholder="Masukkan nomor HP"
                   required>

        </div>

        <!-- BUTTON -->
        <button type="submit"
                class="btn btn-dark">

            Simpan Pelanggan

        </button>

    </form>

</div>

@endsection