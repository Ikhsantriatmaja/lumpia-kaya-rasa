<!DOCTYPE html>
<html>
<head>

    <title>Login Admin - Lumpia Kaya Rasa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
        }

        .login-box{

            width:450px;

            margin:80px auto;

            background:white;

            padding:35px;

            border-radius:15px;

            box-shadow:0 5px 20px rgba(0,0,0,.1);

        }

        .logo{

            text-align:center;

            margin-bottom:25px;

        }

        .logo h2{

            color:#C69656;

            font-weight:bold;

        }

        .btn-login{

            background:#C69656;

            color:white;

            border:none;

        }

        .btn-login:hover{

            background:#b38345;

            color:white;

        }

    </style>

</head>
<body>

<div class="login-box">

    <div class="logo">

        <h2>Lumpia Kaya Rasa</h2>

        <p>Login Admin</p>

    </div>

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif

    <form method="POST"
          action="{{ url('/login') }}">

        @csrf

        <div class="mb-3">

            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   required>

        </div>

        <div class="mb-3">

            <label>Password</label>

            <input type="password"
                   name="password"
                   class="form-control"
                   required>

        </div>

        <button type="submit"
        class="btn btn-login w-100">

    Login

</button>

    <div class="text-center mt-3">

        <a href="{{ route('password.request') }}"
        style="
                color:#C69656;
                text-decoration:none;
                font-weight:bold;
        ">

            Lupa Password?

        </a>

    </div>

    </form>

</div>

</body>
</html>