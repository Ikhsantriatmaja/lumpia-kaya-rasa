@extends('layouts.admin')

@section('content')

<div style="
    background:white;
    padding:30px;
    border-radius:12px;
    max-width:800px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
">

<div style="
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
">

    <h2 style="
        margin:0;
        font-weight:bold;
    ">
        Edit Produk
    </h2>

    <a href="{{ route('produk.index') }}"
       class="btn btn-secondary">

        Kembali

    </a>

</div>

@if ($errors->any())

    <div class="alert alert-danger">

        <ul style="margin-bottom:0;">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<form action="{{ route('produk.update', $produk->id_produk) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div style="margin-bottom:20px;">

        <label style="
            font-weight:bold;
            margin-bottom:8px;
            display:block;
        ">
            Nama Produk
        </label>

        <input type="text"
               name="nama_produk"
               value="{{ $produk->nama_produk }}"
               class="form-control"
               required>

    </div>

    <div style="margin-bottom:20px;">

        <label style="
            font-weight:bold;
            margin-bottom:8px;
            display:block;
        ">
            Harga (Rp)
        </label>

        <input type="number"
               name="harga"
               value="{{ $produk->harga }}"
               min="0"
               class="form-control"
               required>

    </div>

    <div style="margin-bottom:20px;">

        <label style="
            font-weight:bold;
            margin-bottom:8px;
            display:block;
        ">
            Stok
        </label>

        <input type="number"
               name="stok"
               value="{{ $produk->stok }}"
               min="0"
               class="form-control"
               required>

    </div>

    <div style="margin-bottom:20px;">

        <label style="
            font-weight:bold;
            margin-bottom:8px;
            display:block;
        ">
            Deskripsi Produk
        </label>

        <textarea
            name="deskripsi"
            rows="5"
            class="form-control">{{ $produk->deskripsi }}</textarea>

    </div>

    <div style="margin-bottom:20px;">

        <label style="
            font-weight:bold;
            margin-bottom:8px;
            display:block;
        ">
            Gambar Produk
        </label>

        <input type="file"
               name="gambar"
               id="gambar"
               class="form-control"
               accept="image/*">

    </div>

    @if($produk->gambar)

    <div style="margin-bottom:20px;">

        <p style="
            font-weight:bold;
            margin-bottom:10px;
        ">
            Gambar Saat Ini
        </p>

        <img
            id="preview"
            src="{{ asset('storage/'.$produk->gambar) }}"
            style="
                width:220px;
                border-radius:10px;
                border:2px solid #d4af37;
                padding:5px;
            ">

    </div>

    @else

    <img
        id="preview"
        style="
            display:none;
            width:220px;
            border-radius:10px;
            border:2px solid #d4af37;
            padding:5px;
        ">

    @endif

    <button type="submit"
            class="btn btn-dark">

        Update Produk

    </button>

</form>

</div>

<script>

document.getElementById('gambar').addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(event){

            const preview = document.getElementById('preview');

            preview.src = event.target.result;

            preview.style.display = 'block';
        }

        reader.readAsDataURL(file);
    }

});

</script>

@endsection
