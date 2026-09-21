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
            Edit Pelanggan
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
    <form action="{{ route('pelanggan.update', $pelanggan->id_pelanggan) }}"
          method="POST">

        @csrf
        @method('PUT')

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
                   value="{{ $pelanggan->nama }}"
                   class="form-control"
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
                   value="{{ $pelanggan->email }}"
                   class="form-control"
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
                   placeholder="Kosongkan jika tidak diganti">

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
                   value="{{ $pelanggan->alamat }}"
                   class="form-control"
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
                   value="{{ $pelanggan->no_hp }}"
                   minlength="10"
                   class="form-control"
                   required>

        </div>

        <!-- BUTTON -->
        <button type="submit"
                class="btn btn-dark">

            Update Pelanggan

        </button>

    </form>

</div>

@endsection