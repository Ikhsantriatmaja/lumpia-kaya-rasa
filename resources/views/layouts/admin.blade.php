<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>Lumpia Kaya Rasa - Admin</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:Arial,sans-serif;
            background:#f4f6f9;
        }

        /* ======================
            NAVBAR
        ====================== */

        .navbar-admin{

            position:fixed;
            top:0;
            left:0;
            right:0;

            height:75px;

            background:#1A1A1A;

            display:flex;
            justify-content:space-between;
            align-items:center;

            padding:0 30px;

            z-index:1000;

            box-shadow:
                0 5px 20px rgba(0,0,0,.15);
        }

        .navbar-admin h2{

            color:#C69656;
            font-size:24px;
            margin:0;
            font-weight:700;
        }

        .top-right{

            display:flex;
            align-items:center;
            gap:15px;
        }

        /* ======================
            BUTTON
        ====================== */

        .notif{

            background:#dc3545;

            color:white;

            padding:10px 18px;

            border-radius:50px;

            text-decoration:none;

            transition:.3s;
        }

        .notif:hover{

            transform:translateY(-2px);

            color:white;

            background:#bb2d3b;
        }

        .logout-btn{

            background:#C69656;

            color:#fff;

            padding:10px 18px;

            border-radius:50px;

            text-decoration:none;

            transition:.3s;
        }

        .logout-btn:hover{

            background:#b58548;

            color:white;

            transform:translateY(-2px);
        }

        /* ======================
            SIDEBAR
        ====================== */

        .sidebar{

            position:fixed;

            top:75px;
            left:0;

            width:250px;

            height:calc(100vh - 75px);

            background:#ffffff;

            overflow-y:auto;

            border-right:1px solid #eee;

            padding:25px 18px;

            box-shadow:
                5px 0 20px rgba(0,0,0,.03);
        }

        .sidebar-title{

            font-size:13px;

            color:#999;

            margin-bottom:15px;

            text-transform:uppercase;

            letter-spacing:1px;
        }

        .sidebar a{

            display:flex;

            align-items:center;

            gap:10px;

            text-decoration:none;

            color:#444;

            padding:13px 16px;

            border-radius:12px;

            margin-bottom:10px;

            transition:.3s;
        }

        .sidebar a:hover{

            background:#1A1A1A;

            color:#C69656;

            transform:
                translateX(5px);
        }

        .sidebar a.active{

            background:#1A1A1A;

            color:#C69656;

            font-weight:bold;

            box-shadow:
                0 10px 20px rgba(0,0,0,.1);
        }

        /* ======================
            CONTENT
        ====================== */

        .content{

            margin-left:250px;

            margin-top:75px;

            padding:30px;
        }

        /* ======================
            RESPONSIVE
        ====================== */

        @media(max-width:991px){

            .sidebar{

                width:100%;
                height:auto;
                position:relative;
                top:0;
            }

            .content{

                margin-left:0;
                margin-top:20px;
            }

            .navbar-admin{

                position:relative;
            }

        }

    </style>
</head>
<body>

<!-- ======================
        NAVBAR
====================== -->

<div class="navbar-admin">

    <h2>
        Lumpia Kaya Rasa
    </h2>

    <div class="top-right">

        <a
            href="{{ route('kontak.index') }}"
            class="notif">

            🔔 {{ $jumlahPesan }} Pesan
        </a>

        <a
            href="{{ route('logout') }}"
            class="logout-btn">

            Logout
        </a>

    </div>

</div>


<!-- ======================
        SIDEBAR
====================== -->

<div class="sidebar">

    <div class="sidebar-title">
        Main Menu
    </div>

    <a
        href="{{ route('admin.dashboard') }}"
        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

        📊 Dashboard
    </a>

    <a
        href="{{ url('/admin/pesanan') }}"
        class="{{ request()->is('admin/pesanan*') ? 'active' : '' }}">

        🛒 Pesanan
    </a>

    <a
        href="{{ url('/admin/produk') }}"
        class="{{ request()->is('admin/produk*') ? 'active' : '' }}">

        🍱 Produk
    </a>

    <a
        href="{{ url('/admin/pelanggan') }}"
        class="{{ request()->is('admin/pelanggan*') ? 'active' : '' }}">

        👤 Pelanggan
    </a>

    <a
        href="{{ url('/admin/metode-pembayaran') }}"
        class="{{ request()->is('admin/metode-pembayaran*') ? 'active' : '' }}">

        💳 Metode Pembayaran
    </a>

    <a
        href="{{ route('pesanan.laporan') }}"
        class="{{ request()->routeIs('pesanan.laporan') ? 'active' : '' }}">

        📄 Laporan
    </a>

    <a
        href="{{ route('admin.saw') }}"
        class="{{ request()->routeIs('admin.saw') ? 'active' : '' }}">

        🏆 Produk Unggulan
    </a>

    <a
        href="{{ route('kontak.index') }}"
        class="{{ request()->routeIs('kontak.*') ? 'active' : '' }}">

        📩 Pesan Masuk
    </a>

</div>


<!-- ======================
        CONTENT
====================== -->

<div class="content">

    @yield('content')

</div>

</body>
</html>