<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Lumpia Kaya Rasa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        *{

            margin:0;

            padding:0;

            box-sizing:border-box;

        }

        html{

            scroll-behavior:smooth;

        }

        body{

            font-family:'Plus Jakarta Sans',sans-serif;

            background:#FAFAFA;

            color:#1f2937;

            overflow-x:hidden;

        }

        /* ==========================
                NAVBAR
        =========================== */

        .premium-navbar{

            position:fixed;

            top:0;

            left:0;

            width:100%;

            z-index:999;

            transition:.35s ease;

            padding:18px 0;

            background:#1A1A1A;

            border-bottom:1px solid rgba(255,255,255,.08);

            box-shadow:0 10px 30px rgba(0,0,0,.18);

        }

        .premium-navbar.scrolled{

            padding:14px 0;

            background:#1A1A1A;

            box-shadow:0 15px 40px rgba(0,0,0,.30);

        }

        .navbar-brand{

            font-size:26px;

            font-weight:800;

            color:#C69656 !important;

            letter-spacing:-.5px;

        }

        .navbar-brand i{

            margin-right:6px;

        }

        /* MENU */

        .nav-link{

            position:relative;

            color:#E5E7EB !important;

            font-weight:600;

            padding:12px 18px !important;

            transition:.3s;

        }

        .nav-link{

            overflow:hidden;

        }

        .nav-link:hover{

            transform:translateY(-2px);

        }

        .nav-link:hover{

            color:#C69656 !important;

        }

        .nav-link::after{

            content:"";

            position:absolute;

            bottom:6px;

            left:18px;

            width:0;

            height:2px;

            background:#C69656;

            transition:.35s;

        }

        .nav-link:hover::after{

            width:calc(100% - 36px);

        }

        .nav-link.active{

            color:#C69656 !important;

            font-weight:700;

        }

        .nav-link.active::after{

            width:calc(100% - 36px);

        }

        /* USER */

        .user-profile{

            display:flex;

            align-items:center;

            gap:12px;

        }

        .user-profile{

            transition:.35s;

            cursor:pointer;

        }

        .user-profile:hover{

            transform:translateY(-2px);

        }

        .avatar{

            transition:.35s;

        }

        .user-profile:hover .avatar{

            transform:rotate(10deg) scale(1.08);

        }

        .avatar{

            width:46px;

            height:46px;

            border-radius:50%;

            background:linear-gradient(135deg,#C69656,#9E6F35);

            color:white;

            display:flex;

            justify-content:center;

            align-items:center;

            font-size:18px;

            font-weight:bold;

            box-shadow:0 8px 20px rgba(198,150,86,.35);

        }

        .user-name{

            font-size:14px;

            color:#D1D5DB;

            font-weight:500;

        }

        .user-name strong{

            display:block;

            font-size:16px;

            font-weight:700;

            color:#C69656;

            letter-spacing:-0.3px;

        }

        /* DROPDOWN */

        .dropdown-menu{

            border:none;

            border-radius:18px;

            padding:10px;

            box-shadow:0 20px 50px rgba(0,0,0,.12);

        }

        .dropdown-item{

            border-radius:12px;

            padding:10px 14px;

            font-weight:600;

        }

        .dropdown-item:hover{

            background:#F9F4EE;

            color:#C69656;

        }

        /* LOGOUT */

        .logout-btn{

            color:#dc3545 !important;

        }

        /* CONTENT */

    .page-content{

        padding-top:105px;

        min-height:100vh;

        animation:fadePage .5s ease;

    }

    @keyframes fadePage{

        from{

            opacity:0;

            transform:translateY(15px);

        }

        to{

            opacity:1;

            transform:translateY(0);

        }

    }

        /* MOBILE */

        @media(max-width:991px){

            .premium-navbar{

                padding:14px 0;

            }

            .navbar-collapse{

                margin-top:15px;

                background:black;

                border-radius:18px;

                padding:20px;

                box-shadow:0 15px 40px rgba(0,0,0,.08);

            }

            .user-profile{

                margin-top:20px;

                justify-content:center;

            }

            

        }

    </style>

    @stack('styles')

</head>

<body>

<nav class="navbar navbar-expand-lg premium-navbar">

    <div class="container">

        <a class="navbar-brand"
           href="/">

            <i class="bi bi-shop"></i>

            Lumpia Kaya Rasa

        </a>

        <button class="navbar-toggler border-0 shadow-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">

            <i class="bi bi-list"
               style="
                    font-size:30px;
                    color:#C69656;
               ">
            </i>

        </button>

        <div class="collapse navbar-collapse"
             id="navbarMenu">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">

                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                       href="/">

                        Beranda

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}"
                       href="{{ route('pelanggan.dashboard') }}">

                        Dashboard

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->is('produk') ? 'active' : '' }}"
                       href="/produk">

                        Produk

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('pesanan.saya') ? 'active' : '' }}"
                        href="{{ route('pesanan.saya') }}">

                        Pesanan Saya

                    </a>

                </li>

            </ul>


            <div class="dropdown">

                <a
                    href="#"

                    class="text-decoration-none"

                    data-bs-toggle="dropdown">

                    <div class="user-profile">

                        <div class="avatar">

                            {{ strtoupper(substr(session('pelanggan_nama'),0,1)) }}

                        </div>

                        <div class="user-name">

                            Halo,

                            <strong>

                                {{ session('pelanggan_nama') }}

                            </strong>

                        </div>

                        <i class="bi bi-chevron-down"></i>

                    </div>

                </a>


                <ul class="dropdown-menu dropdown-menu-end">

                    <li>

                        <a
                            class="dropdown-item"

                            href="{{ route('pelanggan.dashboard') }}">

                            <i class="bi bi-speedometer2 me-2"></i>

                            Dashboard

                        </a>

                    </li>

                    <li>

                        <a
                            class="dropdown-item"

                            href="/produk">

                            <i class="bi bi-bag me-2"></i>

                            Produk

                        </a>

                    </li>

                    <li>

                        <a
                            class="dropdown-item"

                            href="{{ route('pesanan.saya') }}">

                            <i class="bi bi-receipt me-2"></i>

                            Pesanan Saya

                        </a>

                    </li>

                    <li>

                        <hr class="dropdown-divider">

                    </li>

                    <li>

                        <a
                            class="dropdown-item logout-btn"

                            href="{{ route('pelanggan.logout') }}">

                            <i class="bi bi-box-arrow-right me-2"></i>

                            Logout

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </div>

</nav>


<div class="page-content">

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    // ==========================
    // Navbar Blur + Shrink
    // ==========================

    const navbar = document.querySelector('.premium-navbar');

    window.addEventListener('scroll', function () {

        if (window.scrollY > 40) {

            navbar.classList.add('scrolled');

        } else {

            navbar.classList.remove('scrolled');

        }

    });

    // ==========================
    // Active Link Otomatis
    // ==========================

    document.querySelectorAll('.nav-link').forEach(function(link){

        link.addEventListener('click',function(){

            document.querySelectorAll('.nav-link')
                .forEach(l=>l.classList.remove('active'));

            this.classList.add('active');

        });

    });

    // ==========================
    // Fade Down Navbar
    // ==========================

    navbar.animate(

        [

            {

                opacity:0,

                transform:'translateY(-40px)'

            },

            {

                opacity:1,

                transform:'translateY(0px)'

            }

        ],

        {

            duration:700,

            easing:'ease'

        }

    );

</script>

@stack('scripts')

</body>

</html>