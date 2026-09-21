<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register Pelanggan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        *{
            font-family:'Plus Jakarta Sans',sans-serif;
        }

        body{
            min-height:100vh;
            background:
                radial-gradient(circle at top left,#FFF4E6 0%,transparent 35%),
                radial-gradient(circle at bottom right,#F3F4F6 0%,transparent 40%),
                #F8FAFC;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:30px 15px;
        }

        .register-box{

            width:100%;
            max-width:650px;

            background:#fff;

            padding:45px;

            border-radius:30px;

            box-shadow:
                0 20px 60px rgba(0,0,0,.10);

            border:1px solid #F1F1F1;
        }

        .logo-login{

            width:90px;
            height:90px;

            border-radius:50%;

            padding:8px;

            background:white;

            box-shadow:
                0 10px 30px rgba(198,150,86,.25);

            display:block;
            margin:auto;
        }

        .register-title{

            font-size:32px;
            font-weight:800;
            color:#1A1A1A;
        }

        .register-subtitle{

            color:#94A3B8;
            font-size:14px;
        }

        .form-label{

            font-weight:600;
            color:#475569;
        }

        .form-control{

            border-radius:15px;
            height:55px;
            border:1px solid #E2E8F0;
            padding-left:18px;
        }

        textarea.form-control{

            height:120px;
            padding-top:15px;
            resize:none;
        }

        .form-control:focus{

            border-color:#C69656;

            box-shadow:
                0 0 0 4px rgba(198,150,86,.15);
        }

        .btn-register{

            height:55px;

            background:#C69656;

            border:none;

            border-radius:15px;

            font-weight:700;

            transition:.3s;
        }

        .btn-register:hover{

            background:#B08243;

            transform:translateY(-2px);
        }

        .link-custom{

            color:#C69656;

            text-decoration:none;

            font-weight:600;
        }

        .link-custom:hover{

            color:#B08243;
        }

        .alert{

            border:none;

            border-radius:15px;
        }

    </style>

</head>
<body>

<div class="register-box">

    <img
        src="{{ asset('assets/images/Logo.jpeg') }}"
        class="logo-login">

    <h2 class="text-center mt-4 register-title">

        Daftar Akun

    </h2>

    <p class="text-center register-subtitle mb-4">

        Buat akun untuk mulai memesan
        Lumpia Kaya Rasa

    </p>

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="/register-pelanggan" method="POST">

        @csrf

        <div class="mb-3">

            <label class="form-label">

                Nama Lengkap

            </label>

            <input
                type="text"
                name="nama"
                class="form-control"
                value="{{ old('nama') }}"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Email

            </label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Password

            </label>

            <div class="input-group">

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    required>

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    onclick="togglePassword()">

                    👁

                </button>

            </div>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Konfirmasi Password

            </label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Alamat

            </label>

            <textarea
                name="alamat"
                class="form-control"
                required>{{ old('alamat') }}</textarea>

        </div>

        <div class="mb-4">

            <label class="form-label">

                Nomor HP

            </label>

            <input
                type="text"
                name="no_hp"
                class="form-control"
                value="{{ old('no_hp') }}"
                required>

        </div>

        <button
            type="submit"
            class="btn btn-register text-white w-100">

            Daftar Sekarang

        </button>

    </form>

    <div class="text-center mt-4">

        Sudah punya akun?

        <a
            href="/login-pelanggan"
            class="link-custom">

            Login

        </a>

    </div>

    <div class="text-center mt-2">

        <a
            href="/"
            class="text-secondary text-decoration-none">

            ← Kembali ke Landing Page

        </a>

    </div>

</div>

<script>

function togglePassword(){

    let password =
        document.getElementById('password');

    if(password.type === 'password'){

        password.type = 'text';

    }else{

        password.type = 'password';

    }

}

</script>

</body>
</html>