<!DOCTYPE html>
<html>
<head>

    <title>Lupa Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="background:#f5f5f5;">

<div class="container">

    <div class="card mx-auto mt-5"
         style="max-width:500px;">

        <div class="card-body">

            <h3 class="text-center mb-4">
                Lupa Password
            </h3>

            @if(session('error'))

                <div class="alert alert-danger">

                    {{ session('error') }}

                </div>

            @endif

            <form method="POST"
                  action="{{ route('password.email') }}">

                @csrf

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control mb-3"
                    required>

                <button
                    type="submit"
                    class="btn btn-dark w-100">

                    Kirim OTP

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>