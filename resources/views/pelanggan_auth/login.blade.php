<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Pelanggan</title>

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
            padding:20px;
        }

        .login-wrapper{
            width:100%;
            max-width:1000px;
            background:white;
            border-radius:35px;
            overflow:hidden;
            box-shadow:
                0 20px 60px rgba(0,0,0,.10);
        }

        .left-side{
            background:
                linear-gradient(
                    135deg,
                    #1A1A1A,
                    #2B2B2B
                );
            color:white;
            padding:60px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            height:100%;
        }

        .left-side h1{
            font-size:42px;
            font-weight:800;
            margin-bottom:20px;
        }

        .left-side p{
            color:#CBD5E1;
            line-height:1.8;
        }

        .logo-login{
            width:95px;
            height:95px;
            border-radius:50%;
            background:white;
            padding:8px;
            margin-bottom:30px;
            box-shadow:
                0 10px 30px rgba(198,150,86,.35);
        }

        .right-side{
            padding:60px;
        }

        .login-title{
            font-size:34px;
            font-weight:800;
            color:#1A1A1A;
        }

        .login-subtitle{
            color:#94A3B8;
            margin-bottom:35px;
        }

        .form-label{
            font-weight:600;
            color:#475569;
        }

        .form-control{
            height:55px;
            border-radius:15px;
            border:1px solid #E2E8F0;
            padding-left:18px;
        }

        .form-control:focus{
            border-color:#C69656;
            box-shadow:
                0 0 0 4px rgba(198,150,86,.15);
        }

        .input-group button{
            border-radius:0 15px 15px 0;
        }

        .btn-login{
            height:55px;
            background:#C69656;
            border:none;
            border-radius:15px;
            font-weight:700;
            transition:.3s;
        }

        .btn-login:hover{
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

        @media(max-width:992px){

            .left-side{
                display:none;
            }

            .right-side{
                padding:40px 30px;
            }

        }

    </style>

</head>
<body>

<div class="login-wrapper">

    <div class="row g-0">

        <div class="col-lg-6">

            <div class="left-side">

                <img
                    src="{{ asset('assets/images/Logo.jpeg') }}"
                    class="logo-login">

                <h1>
                    Lumpia Kaya Rasa
                </h1>

                <p>

                    Nikmati cita rasa lumpia terbaik dengan proses pemesanan yang mudah, cepat, dan modern.

                </p>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="right-side">

                <h2 class="login-title">
                    Selamat Datang 👋
                </h2>

                <p class="login-subtitle">
                    Silakan login untuk melanjutkan pemesanan.
                </p>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form
                    action="/login-pelanggan"
                    method="POST"
                    id="loginForm">

                    @csrf

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

                    <div class="mb-4">

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

                    <button
                        class="btn btn-login text-white w-100"
                        id="loginBtn">

                        Login

                    </button>

                </form>

                <div class="text-center mt-4">

                    <a
                        href="{{ route('password.request') }}"
                        class="link-custom">

                        Lupa Password?

                    </a>

                </div>

                <div class="text-center mt-3">

                    Belum punya akun?

                    <a
                        href="/register-pelanggan"
                        class="link-custom">

                        Daftar

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

        </div>

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

document.getElementById("loginForm")
.addEventListener("submit",function(){

    let btn =
        document.getElementById("loginBtn");

    btn.innerHTML =
        "Loading...";

    btn.disabled = true;
});

</script>

</body>
</html>