<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lumpia Kaya Rasa</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>
    /* 1. VARIABEL TEMA & DASAR (Ubah warna utama di sini) */
    :root {
        --gold: #C69656;
        --dark: #121212;
        --bg-body: #F8FAFC;
        --text-main: #0F172A;
        --text-muted: #64748B;
    }
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-body); color: var(--text-main); }

    /* 2. NAVBAR MODERN */
    .modern-navbar { background-color: rgba(18, 18, 18, 0.95); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(198, 150, 86, 0.2); padding: 12px 0; transition: 0.35s ease; }
    .modern-navbar.scrolled { padding: 10px 0; box-shadow: 0 8px 30px rgba(0,0,0,0.18); }
    .logo-navbar { width: 45px; height: 45px; object-fit: cover; border-radius: 50%; background: white; padding: 3px; border: 2px solid rgba(198,150,86,.4); transition: 0.35s; }
    .logo-navbar:hover { transform: scale(1.08); box-shadow: 0 10px 25px rgba(198,150,86,.4); }
    .navbar-brand { color: var(--gold) !important; font-weight: 800; font-size: 1.3rem; display: flex; align-items: center; gap: 12px; letter-spacing: -0.5px; }
    .nav-link { color: #CBD5E1 !important; font-weight: 500; padding: 8px 16px !important; border-radius: 10px; transition: 0.3s; }
    .nav-link:hover, .nav-link.active { color: var(--gold) !important; }

    /* 3. HERO SECTION */
    .hero { position: relative; min-height: 100vh; background: linear-gradient(135deg, #111111 0%, #1A1A1A 40%, #2A2A2A 100%); padding: 140px 8% 100px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,.12); border-bottom: 1px solid rgba(198, 150, 86, 0.3); }
    .hero-bg-image { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('{{ asset('assets/images/hero-bg.png') }}') center center / cover no-repeat; opacity: 0.25; z-index: 0; }
    .hero::before { content:''; position:absolute; width:600px; height:600px; top:-250px; right:-200px; background: radial-gradient(circle, rgba(198,150,86,.18), transparent 70%); border-radius:50%; filter:blur(50px); z-index:0; }
    .hero::after { content:''; position:absolute; width:450px; height:450px; bottom:-220px; left:-180px; background: radial-gradient(circle, rgba(198,150,86,.10), transparent 70%); border-radius:50%; filter:blur(50px); z-index:0; }
    .hero-content { display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1; flex-wrap: wrap; gap: 40px; }
    .hero-text { max-width: 600px; color: #ffffff; }
    .hero h1 { font-size: 4rem; font-weight: 800; margin-bottom: 20px; line-height: 1.1; letter-spacing: -1px; }
    .hero h1 .highlight { color: var(--gold); }
    .hero p { font-size: 1.15rem; color: #E2E8F0; margin-bottom: 35px; line-height: 1.7; }
    .hero-image img { width: 400px; height: 400px; object-fit: cover; border-radius: 70%; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3); position: center; z-index: 1; border: 4px solid rgba(198, 150, 86, 0.2); }

    .about-text{
        font-size:16px;
        line-height:2;
        color:#6B7280;
        text-align:justify;
    }

    /* 4. KARTU & TOMBOL */
    .btn-gold { background-color: var(--gold); color: #fff; padding: 12px 28px; font-weight: 700; border-radius: 50px; text-decoration: none; border: none; transition: 0.3s ease; display: inline-block; }
    .btn-gold:hover { background-color: #a67b40; color: #fff; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(198,150,86,.3); }
    .btn-outline-gold { border: 2px solid var(--gold); color: var(--gold); padding: 8px 20px; font-weight: 700; border-radius: 50px; transition: 0.3s; text-decoration: none; }
    .btn-outline-gold:hover { background: var(--gold); color: #fff; }
    .section-title { text-align: center; color: var(--dark); font-weight: 800; margin-bottom: 40px; font-size: 2rem; letter-spacing: -0.5px; }
    .card-premium { background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,.02); transition: 0.3s; overflow: hidden; }
    .card-premium:hover { transform: translateY(-8px); box-shadow: 0 20px 30px rgba(0,0,0,.08); border-color: #CBD5E1; }

    /* 5. FOOTER */
    footer { background: var(--dark) !important; padding: 70px 20px 30px; color: #E2E8F0; border-top: 4px solid var(--gold); position: relative; overflow: hidden; }
    footer h4 { color: var(--gold); font-weight: 800; margin-bottom: 25px; font-size: 1.2rem; }
    footer ul li { color: #CBD5E1; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; }
    .sosmed-icon { color: var(--gold); font-size: 24px; transition: 0.3s; }
    .sosmed-icon:hover { color: #fff; transform: scale(1.1); }html,
    footer#kontak {
    width: 100vw !important;
    max-width: 100vw !important;
    margin-left: calc(50% - 50vw) !important;
    margin-right: calc(50% - 50vw) !important;
    border-radius: 0 !important;
}

</style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top modern-navbar">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/logo.jpeg') }}" alt="Logo" class="logo-navbar">
            <span>Lumpia Kaya Rasa</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="filter: invert(1);">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto gap-2">
                <li class="nav-item"><a href="#hero" class="nav-link">Beranda</a></li>
                <li class="nav-item"><a href="#about" class="nav-link">Tentang Kami</a></li>
                <li class="nav-item"><a href="#menu" class="nav-link">Menu</a></li>
                <li class="nav-item"><a href="#penilaian-produk" class="nav-link">Penilaian</a></li>
                <li class="nav-item"><a href="#faq" class="nav-link">FAQ</a></li>
                <li class="nav-item"><a href="#kontak" class="nav-link">Kontak</a></li>
            </ul>
            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                @if(session('pelanggan_id'))
                    <a href="/produk" class="nav-link fw-bold" style="color: var(--gold) !important;">Order</a>
                    <a href="/dashboard-pelanggan" class="btn-outline-gold px-4">👤 {{ session('pelanggan_nama') }}</a>
                    <a href="/logout-pelanggan" class="btn btn-danger rounded-pill fw-bold px-4">Logout</a>
                @else
                    <a href="/login-pelanggan" class="btn-outline-gold px-4">Login</a>
                    <a href="/register-pelanggan" class="btn-gold px-4">Register</a>
                @endif
            </div>
        </div>
    </div>
</nav>

<section id="hero" class="hero">                                            
  <div class="hero-bg-image"></div>
  <div class="container hero-content">
    <div class="hero-text">
      <h1><span class="highlight">Lumpia</span> Kaya Rasa</h1>
      <p>
        Lumpia Kaya Rasa, pilihan terbaik untuk cita rasa istimewa dan bahan berkualitas. 
        Dibuat dengan resep turun-temurun dan bahan segar pilihan, kami hadir untuk 
        memberikan pengalaman kuliner yang otentik. Cocok untuk semua acara!
      </p>
      <div class="mt-4">
        <a href="#menu" class="btn-gold me-3">Lihat Menu</a>
        <a href="#about" class="text-white text-decoration-none fw-semibold">Pelajari Lebih Lanjut <i class="bi bi-arrow-right ms-1"></i></a>
      </div>
    </div>
    <div class="hero-image d-none d-lg-block">
      <img src="{{ asset('assets/images/hero-image.png') }}" alt="Lumpia Kaya Rasa">
    </div>
  </div>
</section>

<section id="about" class="py-5" style="background-color: #FFFFFF;">
    <div class="container py-5">
        <h2 class="section-title"><span style="color: var(--gold);">Tentang</span> Kami</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center" style="color: var(--text-muted); font-size: 1.05rem; line-height: 1.8;">
                <p><strong>Lumpia Kaya Rasa</strong> adalah camilan gurih yang memiliki keunikan rasa melalui perpaduan isian rebung muda yang renyah dan potongan ayam pilihan yang diolah menggunakan bumbu khas. Setiap proses pembuatan dilakukan dengan penuh perhatian untuk menghasilkan cita rasa yang lezat, gurih, dan mampu memberikan pengalaman kuliner yang berkesan di setiap gigitan.</p>

                <p>Bahan-bahan yang digunakan selalu dipilih dari bahan segar dan berkualitas tanpa mengurangi keaslian cita rasa tradisional. Dengan resep turun-temurun dari keluarga Ibu Ngatini, Lumpia Kaya Rasa terus mempertahankan kualitas dan konsistensi rasa yang telah dipercaya oleh pelanggan. Proses pengolahan yang higienis dan penggunaan bahan alami menjadi salah satu komitmen kami dalam menghadirkan produk terbaik.</p>

                <p>Tidak hanya menghadirkan cita rasa yang khas, Lumpia Kaya Rasa juga terus berinovasi dalam memberikan pelayanan kepada pelanggan. Kami menyediakan layanan pembelian secara langsung maupun pemesanan secara online sehingga pelanggan dapat menikmati produk dengan lebih mudah, praktis, dan nyaman.</p>

                <p>Saat ini, <strong>Lumpia Kaya Rasa</strong> telah hadir dan melayani pelanggan di dua kota di Jawa Tengah, yaitu <strong>Solo dan Klaten</strong>. Selain melayani pembelian untuk konsumsi pribadi, kami juga menerima pesanan dalam jumlah besar untuk berbagai acara seperti arisan, rapat, ulang tahun, acara keluarga, maupun kegiatan lainnya. Kepuasan pelanggan serta kualitas produk akan selalu menjadi prioritas utama kami dalam menjaga kepercayaan yang telah diberikan.</p>
            </div>
    </div>

    <div class="row mt-5 text-center">

        <div class="col-md-4 mb-4">
            <h2 style="color: var(--gold); font-weight:700;">
                100%
            </h2>
            <p>Bahan Berkualitas</p>
        </div>

        <div class="col-md-4 mb-4">
            <h2 style="color: var(--gold); font-weight:700;">
                2 Kota
            </h2>
            <p>Area Pelayanan</p>
        </div>

        <div class="col-md-4 mb-4">
            <h2 style="color: var(--gold); font-weight:700;">
                Terjamin
            </h2>
            <p>Rasa dan Kualitas</p>
        </div>

    </div>  
</section>

<section id="menu" class="py-5" style="background-color: var(--bg-body);">
  <div class="container py-4">
    <h2 class="section-title">Menu <span style="color: var(--gold);">Spesial</span></h2>
    <div class="row g-4 mt-2">
      @foreach($produk as $p)
      <div class="col-md-3">
        <div class="card card-premium h-100 border-0">
          <img src="{{ $p->gambar ? asset('storage/'.$p->gambar) : 'https://via.placeholder.com/300x200' }}" class="card-img-top" style="height:220px; object-fit:cover;">
          <div class="card-body p-4 d-flex flex-column text-center">
            <h5 class="fw-bold mb-2 text-dark">{{ $p->nama_produk }}</h5>
            <p style="font-size: 0.9rem; color: var(--text-muted); min-height: 50px; margin-bottom: 15px;">{{ $p->deskripsi }}</p>
            <div class="mt-auto">
                <p class="mb-1" style="font-size: 0.85rem; color: var(--text-muted);"><i class="bi bi-box-seam me-1"></i> Stok: <strong>{{ $p->stok }}</strong></p>
                <h4 style="color: var(--gold); font-weight: 800; margin-bottom: 20px;">Rp {{ number_format($p->harga,0,',','.') }}</h4>
                @if(session('pelanggan_id'))
                    <a href="/produk" class="btn-gold w-100 py-2" style="border-radius: 12px;">Pesan Sekarang</a>
                @else
                    <a href="/login-pelanggan" class="btn-gold w-100 py-2" style="border-radius: 12px;">Pesan Sekarang</a>
                @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section id="penilaian-produk" class="py-5" style="background-color: #FFFFFF;">
    <div class="container py-4">
        <h2 class="section-title">Testimoni & <span style="color: var(--gold);">Penilaian</span></h2>

        <div class="row mb-5 justify-content-center">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card card-premium p-4 text-center h-100 justify-content-center border-0">
                    <h1 style="color: var(--gold); font-weight: 800; font-size: 4.5rem; line-height: 1;">{{ $rataRating }}</h1>
                    <div style="color: #F59E0B; font-size: 1.8rem; margin: 10px 0;">{!! str_repeat('★', round($rataRating)) !!}</div>
                    <h5 class="text-muted fw-bold m-0">{{ $totalReview }} Penilaian</h5>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-premium p-4 border-0 h-100">
                    @php $max = max($bintang5, $bintang4, $bintang3, $bintang2, $bintang1, 1); @endphp
                    @foreach([5=>$bintang5, 4=>$bintang4, 3=>$bintang3, 2=>$bintang2, 1=>$bintang1] as $star=>$jumlah)
                    <div class="d-flex align-items-center mb-3">
                        <div style="width: 70px; font-weight: bold; color: var(--text-main);">{{ $star }} ★</div>
                        <div class="progress flex-grow-1" style="height: 10px; background-color: #F1F5F9; border-radius: 10px;">
                            <div class="progress-bar" style="width:{{ ($jumlah/$max)*100 }}%; background-color: var(--gold); border-radius: 10px;"></div>
                        </div>
                        <div style="width: 50px; text-align: right; color: var(--text-muted); font-weight: 600;">{{ $jumlah }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card card-premium border-0 mb-5">
            <div class="card-body p-4">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-4">
                        <label class="fw-bold mb-2 text-dark"><i class="bi bi-box me-1"></i> Filter Produk</label>
                        <select id="filterProduk" class="form-select border-0 bg-light" style="padding: 12px; border-radius: 10px;">
                            <option value="">Semua Produk</option>
                            @foreach($produk as $p)
                                <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="fw-bold mb-2 text-dark"><i class="bi bi-star-fill me-1"></i> Rating</label>
                        <select id="filterRating" class="form-select border-0 bg-light" style="padding: 12px; border-radius: 10px;">
                            <option value="">Semua Rating</option>
                            <option value="5">★★★★★</option>
                            <option value="4">★★★★☆</option>
                            <option value="3">★★★☆☆</option>
                            <option value="2">★★☆☆☆</option>
                            <option value="1">★☆☆☆☆</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="fw-bold mb-2 text-dark"><i class="bi bi-sort-down me-1"></i> Urutkan</label>
                        <select id="sortReview" class="form-select border-0 bg-light" style="padding: 12px; border-radius: 10px;">
                            <option value="new">Terbaru</option>
                            <option value="old">Terlama</option>
                            <option value="high">Rating Tertinggi</option>
                            <option value="low">Rating Terendah</option>
                        </select>
                    </div>
                    <div class="col-lg-2 text-center">
                        <small class="text-muted d-block mb-1">Ditampilkan</small>
                        <h4 id="jumlahReview" style="color: var(--gold); font-weight: 800; margin: 0;">{{ $totalReview }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4" id="reviewContainer">
            @foreach($review as $u)
            <div class="col-md-4 mb-4 review-item" data-produk="{{ $u->id_produk }}" data-rating="{{ $u->rating }}" data-date="{{ strtotime($u->created_at) }}">
                <div class="card card-premium h-100 border-0">
                    <img src="{{ asset('storage/'.$u->foto_produk) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Foto Produk">
                    <div class="card-body p-4 flex-grow-1">
                        <h5 class="fw-bold mb-1 text-dark">{{ $u->produk->nama_produk ?? 'Produk' }}</h5>
                        <div class="mb-3" style="color: #F59E0B; font-size: 1.1rem;">
                            {!! str_repeat('<i class="bi bi-star-fill"></i>', $u->rating) !!}
                            {!! str_repeat('<i class="bi bi-star"></i>', 5 - $u->rating) !!}
                        </div>
                        <p class="card-text" style="font-size: 0.95rem; line-height: 1.6; color: #475569;">"{{ $u->pesan }}"</p>
                    </div>
                    <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                        <div class="mb-3">
                            <small class="text-uppercase fw-bold" style="font-size: 0.7rem; color: #94A3B8;">Oleh</small>
                            <div class="fw-bold text-dark">{{ $u->pelanggan->nama ?? $u->nama }}</div>
                        </div>
                        @if($u->balasan_admin)
                        <div class="p-3 rounded-3" style="background-color: #FFFDF4; border-left: 4px solid var(--gold);">
                            <small class="d-block text-uppercase fw-bold mb-1" style="color: var(--gold); font-size: 0.7rem;">
                                <i class="bi bi-chat-left-dots-fill"></i> Balasan Admin
                            </small>
                            <p class="mb-0 small" style="color: #334155;">{{ $u->balasan_admin }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div> 
        
    </div>
</section>

<section id="review" class="card card-premium mt-5 border-0 p-lg-5 p-4">

    <h3 class="fw-bold text-center mb-4 text-dark">
        Kirim <span style="color: var(--gold);">Review Anda</span>
    </h3>

    @if(session('success'))
        <div class="alert alert-success border-0 bg-success text-white text-center rounded-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('kontak.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row g-4">

            {{-- Produk --}}
            <div class="col-md-6">

                <label class="fw-bold text-dark mb-2">
                    Produk yang diulas
                </label>

                <select
                    name="id_produk"
                    class="form-select bg-light border-0"
                    style="padding:12px; border-radius:10px;"
                    required>

                    <option value="">
                        Pilih Produk
                    </option>

                    @if($produkReview->count() > 0)

                        @foreach($produkReview as $item)

                            <option
                                value="{{ $item->produk->id_produk }}"
                                {{ ($produkDipilih == $item->produk->id_produk && $pesananDipilih == $item->pesanan->id_pesanan) ? 'selected' : '' }}>

                                {{ $item->produk->nama_produk }}
                                - Pesanan tanggal
                                {{ \Carbon\Carbon::parse($item->pesanan->tanggal_pesanan)->translatedFormat('d F Y') }}

                            </option>

                        @endforeach

                    @else

                        <option disabled>
                            Anda belum memiliki produk yang bisa diulas
                        </option>

                    @endif

                </select>

            </div>

            {{-- Rating --}}
            <div class="col-md-6">

                <label class="fw-bold text-dark mb-2">
                    Beri Rating
                </label>

                <select
                    name="rating"
                    class="form-select bg-light border-0"
                    style="padding:12px; border-radius:10px; color:#F59E0B; font-weight:bold;"
                    required>

                    <option value="5">★★★★★ Luar Biasa</option>
                    <option value="4">★★★★☆ Sangat Baik</option>
                    <option value="3">★★★☆☆ Baik</option>
                    <option value="2">★★☆☆☆ Cukup</option>
                    <option value="1">★☆☆☆☆ Kurang</option>

                </select>

            </div>

            {{-- Upload Foto --}}
            <div class="col-md-12">

                <label class="fw-bold text-dark mb-2">
                    Upload Foto Produk
                </label>

                <input
                    type="file"
                    name="foto_produk"
                    class="form-control bg-light border-0"
                    style="padding:12px; border-radius:10px;"
                    accept=".jpg,.jpeg,.png"
                    required>

            </div>

            {{-- Pesan --}}
            <div class="col-md-12">

                <label class="fw-bold text-dark mb-2">
                    Pesan Review
                </label>

                <textarea
                    name="pesan"
                    rows="4"
                    class="form-control bg-light border-0"
                    style="padding:15px; border-radius:15px;"
                    placeholder="Ceritakan pengalaman Anda menikmati produk kami..."
                    required></textarea>

            </div>

            {{-- Tombol --}}
            <div class="col-12 text-end mt-4">

                <button
                    type="submit"
                    class="btn-gold border-0"
                    style="padding:14px 40px; border-radius:12px;">

                    Kirim Review

                </button>

            </div>

        </div>

    </form>

</section>

<section id="faq" class="py-5" style="background-color: var(--bg-body);">
    <div class="container py-5">
        <h2 class="section-title">Pertanyaan <span style="color: var(--gold);">Sering Diajukan</span></h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion border-0" id="faqAccordion">
                    <div class="accordion-item border-0 mb-3 rounded-4 shadow-sm overflow-hidden">
                        <h2 class="accordion-header"><button class="accordion-button fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">Varian Lumpia Apa Saja Yang Tersedia?</button></h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted bg-white border-top">Lumpia Kaya Rasa menyediakan dua pilihan produk, yaitu <strong>Lumpia Frozen</strong> dan <strong>Lumpia Goreng Siap Santap</strong>.</div></div>
                    </div>
                    <div class="accordion-item border-0 mb-3 rounded-4 shadow-sm overflow-hidden">
                        <h2 class="accordion-header"><button class="accordion-button collapsed fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">Berapa Harga Lumpia Kaya Rasa?</button></h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted bg-white border-top">• Lumpia Frozen isi 10 pcs : <strong>Rp35.000</strong><br>• Lumpia Goreng isi 10 pcs : <strong>Rp40.000</strong></div></div>
                    </div>
                    <div class="accordion-item border-0 mb-3 rounded-4 shadow-sm overflow-hidden">
                        <h2 class="accordion-header"><button class="accordion-button collapsed fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">Berapa Isi Dalam Satu Pack?</button></h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted bg-white border-top">Setiap 1 pack Lumpia Kaya Rasa berisi <strong>10 biji lumpia</strong>.</div></div>
                    </div>
                    <div class="accordion-item border-0 mb-3 rounded-4 shadow-sm overflow-hidden">
                        <h2 class="accordion-header"><button class="accordion-button collapsed fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">Apakah Tersedia Gratis Ongkir?</button></h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted bg-white border-top">Ya. Gratis ongkir berlaku untuk area <strong>Solo dan Klaten</strong> dengan minimal pembelian <strong>10 pack</strong>.</div></div>
                    </div>
                    <div class="accordion-item border-0 mb-3 rounded-4 shadow-sm overflow-hidden">
                        <h2 class="accordion-header"><button class="accordion-button collapsed fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">Berapa Lama Produk Dapat Bertahan?</button></h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted bg-white border-top">Lumpia Frozen maupun Lumpia Goreng dapat bertahan hingga <strong>12 jam pada suhu ruang</strong>.<br><br>Untuk menjaga kualitas terbaik, lumpia goreng disarankan dikonsumsi dalam waktu <strong>2 jam setelah digoreng</strong> agar tetap renyah dan krispi.</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer id="kontak">
        <div class="container-fluid px-4 px-lg-5">
        <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0 pe-lg-5">
                <h4>Lumpia Kaya Rasa</h4>
                <p style="color:#94A3B8; line-height:1.8; text-align:justify; font-size: 0.95rem;">Lumpia Kaya Rasa menghadirkan lumpia berkualitas dengan cita rasa khas yang tersedia dalam pilihan frozen maupun goreng siap santap. Cocok untuk konsumsi pribadi, keluarga, acara, maupun oleh-oleh.</p>
                <div class="d-flex gap-3 mt-4">
                    <a href="https://www.instagram.com/lumpiakayarasa" target="_blank" class="sosmed-icon"><i class="bi bi-instagram"></i></a>
                    <a href="https://wa.me/6285741367855" target="_blank" class="sosmed-icon"><i class="bi bi-whatsapp"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100088525196512" target="_blank" class="sosmed-icon"><i class="bi bi-facebook"></i></a>
                </div>
            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4>Hubungi Kami</h4>
                <ul class="list-unstyled p-0 m-0" style="font-size: 0.95rem;">
                    <li><i class="bi bi-telephone-fill" style="color: var(--gold);"></i> 0857-4136-7855</li>
                    <li><i class="bi bi-envelope-fill" style="color: var(--gold);"></i> info@lumpiakayarasa.com</li>
                    <li><i class="bi bi-geo-alt-fill" style="color: var(--gold);"></i> Klaten & Solo, Jawa Tengah</li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h4>Lokasi Penjualan</h4>
                <div style="color:#94A3B8; font-size: 0.9rem; line-height:1.6; margin-bottom:15px;"><strong class="text-white">Stand Harian</strong><br>Depan Banyu Urip Resto<br>Jl. Mayor Kusnanto, Klaten Tengah</div>
                <div style="color:#94A3B8; font-size: 0.9rem; line-height:1.6; margin-bottom:20px;"><strong class="text-white">CFD Klaten (Hari Minggu)</strong><br>• Depan SD Negeri 1 Klaten<br>• Depan Ex Bank Jateng, Jalan Pemuda</div>
                <iframe src="https://www.google.com/maps?q=LUMPIA+KAYA+RASA+KLATEN+2&output=embed" width="100%" height="150" style="border:0; border-radius:15px;" loading="lazy"></iframe>
            </div>
        </div>
        <hr style="border-color: rgba(255,255,255,0.1); margin-top: 50px; margin-bottom: 25px;">
        <div class="text-center pb-3">
            <p style="color:#64748B; margin:0; font-size: 0.9rem;">© 2026 Lumpia Kaya Rasa. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) { document.querySelector('.modern-navbar').classList.add('scrolled'); } 
        else { document.querySelector('.modern-navbar').classList.remove('scrolled'); }
    });

    const filterProduk = document.getElementById('filterProduk');
    const filterRating = document.getElementById('filterRating');
    const sortReview = document.getElementById('sortReview');
    const jumlahReview = document.getElementById('jumlahReview');
    
    // PERBAIKAN: Memanggil berdasarkan ID, bukan berdasarkan class 'row g-4'
    const container = document.getElementById('reviewContainer');

    function updateReview() {
        let cards = [...document.querySelectorAll('.review-item')];
        const produk = filterProduk.value;
        const rating = filterRating.value;

        cards.forEach(card => {
            const show = (produk == '' || card.dataset.produk == produk) && (rating == '' || card.dataset.rating == rating);
            card.style.display = show ? 'block' : 'none';
        });

        let visible = cards.filter(c => c.style.display != 'none');
        jumlahReview.innerHTML = visible.length;

        if (sortReview.value == "high") { visible.sort((a,b) => b.dataset.rating - a.dataset.rating); }
        if (sortReview.value == "low") { visible.sort((a,b) => a.dataset.rating - b.dataset.rating); }
        if (sortReview.value == "new") { visible.sort((a,b) => b.dataset.date - a.dataset.date); }
        if (sortReview.value == "old") { visible.sort((a,b) => a.dataset.date - b.dataset.date); }

        visible.forEach(card => { container.appendChild(card); });
    }

    if(filterProduk && filterRating && sortReview){
        filterProduk.onchange = updateReview;
        filterRating.onchange = updateReview;
        sortReview.onchange = updateReview;
        updateReview();
    }
</script>

</body>
</html>