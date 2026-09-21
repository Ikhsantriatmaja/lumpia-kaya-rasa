<!DOCTYPE html>
<html>
<head>

    <title>Reset Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background:#f5f5f5;">

<div class="container">

    <div class="card mx-auto mt-5"
         style="max-width:500px;">

        <div class="card-body">

            <h3 class="text-center mb-4">
                Reset Password
            </h3>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST"
                  action="{{ route('password.reset') }}">

                @csrf

                <input
                    type="hidden"
                    name="email"
                    value="{{ $email }}">

                <label>Password Baru</label>

                <input
                    type="password"
                    name="password"
                    class="form-control mb-3"
                    required>

                <label>Konfirmasi Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control mb-3"
                    required>

                <button
                    type="submit"
                    class="btn btn-success w-100">

                    Simpan Password Baru

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>

