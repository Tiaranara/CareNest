<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareNest - Manajemen Panti Asuhan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
            --surface: #ffffff;
            --surface-alt: #f4f7ff;
            --text: #1f2c44;
            --muted: #6c7a96;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--surface-alt);
            color: var(--text);
        }

        .navbar {
            background: var(--surface);
            border-bottom: 1px solid rgba(44, 62, 80, 0.08);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary) !important;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--secondary), #4b6bff);
            color: #fff;
        }

        .navbar-nav {
            gap: 0.5rem;
        }

        .nav-link {
            color: var(--text) !important;
            font-weight: 500;
            padding: 0.35rem 0.75rem;
            text-decoration: none !important;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--secondary) !important;
            text-decoration: none !important;
        }

        .btn-primary,
        .btn-outline-primary {
            border-radius: 50px;
            padding: 0.8rem 1.6rem;
            font-weight: 600;
        }

        .btn-primary {
            background: var(--secondary);
            border-color: var(--secondary);
            box-shadow: 0 18px 40px rgba(52, 152, 219, 0.18);
            color: #fff;
        }

        .btn-outline-primary {
            color: var(--secondary);
            border-color: rgba(52, 152, 219, 0.25);
            background: var(--surface);
        }

        .section {
            padding: 5rem 0;
        }

        .section-light {
            background: var(--surface);
        }

        .hero {
            padding: 4rem 0 3rem;
        }

        .hero-title {
            font-size: clamp(2.8rem, 5vw, 4.4rem);
            line-height: 1.03;
            letter-spacing: -0.04em;
            max-width: 700px;
        }

        .hero-text {
            color: var(--muted);
            font-size: 1.05rem;
            margin-top: 1.4rem;
            max-width: 620px;
            line-height: 1.8;
        }

        .hero-grid {
            display: grid;
            gap: 2rem;
            grid-template-columns: 1.35fr 1fr;
            align-items: center;
        }

        .hero-card {
            background: var(--surface);
            border-radius: 28px;
            box-shadow: 0 24px 60px rgba(46, 68, 105, 0.08);
            padding: 2.5rem;
            min-height: 380px;
        }

        .hero-card.hero-image-card {
            padding: 0;
            min-height: auto;
        }

        .hero-card.hero-image-card img {
            width: 100%;
            display: block;
            border-radius: 28px;
            object-fit: cover;
            height: 100%;
            max-height: 100%;
        }

        .hero-card h3 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .hero-card p {
            color: var(--muted);
            line-height: 1.75;
        }

        .stat-row {
            display: grid;
            gap: 1.25rem;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            margin-top: 2.5rem;
        }

        .stat-box {
            background: var(--surface);
            border-radius: 22px;
            padding: 1.75rem;
            box-shadow: 0 20px 50px rgba(46, 68, 105, 0.06);
        }

        .stat-box p {
            margin: 0;
            color: var(--muted);
            text-transform: uppercase;
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            font-weight: 700;
        }

        .stat-box h3 {
            margin: 0.75rem 0 0;
            font-size: 2rem;
            font-weight: 800;
        }

        .stat-box .icon {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            color: #fff;
            margin-left: auto;
        }

        .stat-box.blue .icon {
            background: linear-gradient(135deg, var(--secondary), #4b6bff);
        }

        .stat-box.green .icon {
            background: linear-gradient(135deg, #20c997, #10b981);
        }

        .stat-box.indigo .icon {
            background: linear-gradient(135deg, #6f42c1, #4b6bff);
        }

        .stat-box.orange .icon {
            background: linear-gradient(135deg, #ff7b6f, #ffb26f);
        }

        .section-heading {
            margin-bottom: 3rem;
            text-align: center;
        }

        .section-heading h2 {
            font-weight: 800;
            letter-spacing: -0.04em;
        }

        .section-heading p {
            color: var(--muted);
        }

        .feature-card,
        .data-card,
        .need-card,
        .contact-card {
            border-radius: 24px;
            background: var(--surface);
            border: 1px solid rgba(46, 68, 105, 0.08);
            box-shadow: 0 22px 60px rgba(46, 68, 105, 0.06);
        }

        .feature-card {
            padding: 2rem;
            min-height: 230px;
        }

        .feature-card .icon {
            width: 56px;
            height: 56px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            color: #fff;
            margin-bottom: 1rem;
            font-size: 1.35rem;
        }

        .bg-blue {
            background: var(--secondary);
        }

        .bg-green {
            background: #20c997;
        }

        .bg-indigo {
            background: #6f42c1;
        }

        .bg-orange {
            background: #ff7b6f;
        }

        .feature-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .feature-text {
            color: var(--muted);
            line-height: 1.75;
        }

        .data-scroll-wrapper {
            overflow-x: auto;
            padding-bottom: 1rem;
            margin-left: -0.75rem;
            margin-right: -0.75rem;
        }

        .data-scroll {
            display: flex;
            gap: 1.25rem;
            padding: 0.75rem;
        }

        .data-card-item {
            flex: 0 0 280px;
            width: 280px;
            scroll-snap-align: start;
        }

        .data-card {
            display: flex;
            flex-direction: column;
            height: 430px;
        }

        .data-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 24px;
            border-top-right-radius: 24px;
        }

        .data-card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex: 1;
        }

        .data-card-body h5 {
            font-weight: 700;
            margin-bottom: 0.65rem;
        }

        .data-card-body small,
        .need-card-meta,
        .contact-card p {
            color: var(--muted);
        }

        .need-card {
            padding: 1.6rem 1.8rem;
            border-left: 4px solid #ff7b6f;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .need-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 28px 70px rgba(46, 68, 105, 0.12);
        }

        .need-card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #fff4e7;
            color: #e07b2a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            margin-bottom: 1rem;
            flex-shrink: 0;
        }

        .need-card-title {
            font-weight: 700;
            margin-bottom: 0.35rem;
            font-size: 1.05rem;
            color: var(--primary);
        }

        .need-card-meta {
            font-size: 0.85rem;
            margin: 0.2rem 0;
            color: var(--muted);
        }

        .need-card-progress {
            margin-top: 1rem;
            height: 6px;
            border-radius: 999px;
            background: #f0eeff;
            overflow: hidden;
        }

        .need-card-progress-bar {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #ff7b6f, #f5a623);
        }

        .badge-status {
            font-size: 0.78rem;
            padding: 0.4rem 0.85rem;
            border-radius: 999px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-status.pending {
            background: #fff4e7;
            color: #b05628;
        }

        .badge-status.done {
            background: #e8faf0;
            color: #157347;
        }

        .kebutuhan-section-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .kebutuhan-section-icon {
            width: 56px;
            height: 56px;
            border-radius: 18px;
            background: linear-gradient(135deg, #ff7b6f, #f5a623);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .contact-card {
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .contact-card::before {
            content: '';
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(52, 152, 219, 0.12);
            top: -40px;
            right: -70px;
            z-index: 0;
        }

        .contact-card-body {
            position: relative;
            z-index: 1;
        }

        .landing-footer {
            background: var(--primary);
            color: #e7ecff;
            padding: 3rem 0 2rem;
            border: none;
            box-shadow: none;
        }

        .landing-footer h5 {
            color: #fff;
            margin-bottom: 1.2rem;
            font-weight: 700;
        }

        .landing-footer p,
        .landing-footer .footer-links a,
        .landing-footer .footer-links li {
            color: rgba(255, 255, 255, 0.75);
        }

        .landing-footer .footer-links a {
            text-decoration: none;
        }

        .landing-footer .footer-links a:hover {
            color: #fff;
            text-decoration: none;
        }

        .landing-footer .d-flex a {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            text-decoration: none;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .landing-footer .d-flex a:hover {
            background: rgba(255, 255, 255, 0.16);
            transform: translateY(-2px);
            text-decoration: none;
        }

        .hero-wave {
            background: var(--surface-alt);
            line-height: 0;
        }

        .hero-wave svg {
            display: block;
            width: 100%;
            height: auto;
        }

        @media (max-width: 991px) {
            .hero-grid {
                grid-template-columns: 1fr;
            }

            .stat-row {
                grid-template-columns: 1fr;
            }

            .data-card {
                height: auto;
            }

            .data-card img {
                height: 180px;
            }
        }

        @media (max-width: 767px) {
            .navbar-nav {
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero {
                padding-top: 3rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                CareNest
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#data">Data</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kebutuhan">Kebutuhan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#donasi">Donasi</a></li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
            </div>
        </div>
    </nav>

    <section class="hero" id="home">
        <div class="container">
            <div class="hero-grid">
                <div>
                    <span class="hero-badge"><i class="fas fa-heart"></i> Semua donasi mudah dikelola</span>
                    <h1 class="hero-title">Selamat datang di <span style="color: var(--secondary);">CareNest</span>, pusat manajemen panti asuhan.</h1>
                    <p class="hero-text">Kelola data anak panti, donatur, donasi, dan kebutuhan secara cepat. Tampilan rapi yang memudahkan proses pelaporan dan monitoring bantuan.</p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary">Lihat selengkapnya</a>
                        <a href="#fitur" class="btn btn-outline-primary">Lihat Fitur</a>
                    </div>
                </div>
                <div>
                    <div class="hero-card hero-image-card">
                        <img src="https://i.pinimg.com/1200x/0a/90/25/0a9025e0d5a13589ceb4016c95387d15.jpg" alt="Gambar hero CareNest" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="hero-wave">
        <svg viewBox="0 0 1440 320" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path fill="var(--surface)" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,197.3C384,192,480,160,576,149.3C672,139,768,149,864,170.7C960,192,1056,224,1152,229.3C1248,235,1344,213,1392,202.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>

    <section class="section section-light" id="fitur">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Fitur Utama CareNest</h2>
                <p>Fitur-fitur praktis yang mendukung pengelolaan anak panti dan donasi secara efisien.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card h-100">
                        <div class="icon bg-blue"><i class="fas fa-child"></i></div>
                        <div class="feature-title">Data Anak Panti</div>
                        <div class="feature-text">Kelola profil anak panti lengkap dengan usia, jenis kelamin, dan status.</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card h-100">
                        <div class="icon bg-green"><i class="fas fa-users"></i></div>
                        <div class="feature-title">Data Donatur</div>
                        <div class="feature-text">Simpan data donatur dan pantau kontribusi mereka dengan mudah.</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card h-100">
                        <div class="icon" style="background: linear-gradient(135deg, #6f42c1, #1e56ff);"><i class="fas fa-hand-holding-usd"></i></div>
                        <div class="feature-title">Catat Donasi</div>
                        <div class="feature-text">Input donasi uang atau barang dengan tanggal, jumlah, dan keterangan.</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card h-100">
                        <div class="icon" style="background: linear-gradient(135deg, #ff7b6f, #ffb26f);"><i class="fas fa-boxes"></i></div>
                        <div class="feature-title">Kebutuhan Panti</div>
                        <div class="feature-text">Pantau kebutuhan yang belum terpenuhi dan prioritaskan bantuan dengan cepat.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="data">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Data Anak Panti</h2>
            </div>
            <div class="data-scroll-wrapper">
                <div class="data-scroll">
                    @forelse ($recentAnakPanti as $anak)
                        <div class="data-card-item">
                            <div class="data-card">
                                <img src="{{ $anak->foto ? asset('storage/' . $anak->foto) : 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=800&q=80' }}" alt="Anak Panti">
                                <div class="data-card-body">
                                    <h5>{{ $anak->nama }}</h5>
                                    <small>{{ $anak->getUmur() }} tahun · {{ ucfirst($anak->jenis_kelamin) }}</small>
                                    <p class="text-gray">Status: {{ ucfirst($anak->status) }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="feature-card text-center">
                                <h3>Belum ada data anak panti</h3>
                                <p>Silakan tambahkan data anak panti melalui dashboard setelah login.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="section section-light" id="kebutuhan">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Kebutuhan Panti Prioritas</h2>
                <p>Kebutuhan panti yang saat ini masih menunggu dukungan dan harus segera dipenuhi.</p>
            </div>
            <div class="row g-4">
                @forelse ($unfulfilledKebutuhan as $kebutuhan)
                    <div class="col-lg-6">
                        <div class="need-card">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                                <div class="need-card-title">{{ $kebutuhan->nama_kebutuhan }}</div>
                                <span class="badge-status pending">Belum Terpenuhi</span>
                            </div>
                            <p class="need-card-meta">Jumlah: <strong>{{ $kebutuhan->jumlah_kebutuhan }}</strong></p>
                            <p class="need-card-meta">Diajukan: {{ optional($kebutuhan->tanggal_pengajuan)->format('d M Y') }}</p>
                            <div class="need-card-progress mt-3">
                                <div class="need-card-progress-bar" style="width: {{ rand(15, 60) }}%"></div>
                            </div>
                            <p class="need-card-meta mt-1" style="font-size:0.78rem;">Sedang diupayakan</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="feature-card text-center py-5">
                            <div style="font-size:3rem; margin-bottom:1rem;">🎉</div>
                            <h3>Semua kebutuhan sudah terpenuhi!</h3>
                            <p style="color: var(--muted);">Tidak ada kebutuhan yang tertunda saat ini. Terima kasih atas dukungan para donatur.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section" id="kontak">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Kontak CareNest</h2>
                <p>Hubungi kami jika ingin mendapatkan dukungan teknis atau informasi aplikasi.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="feature-card">
                        <h3>Alamat</h3>
                        <p class="text-gray">JJl. Aurora Kencana No. 9, Sleman, Yogyakarta</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="feature-card">
                        <h3>Kontak</h3>
                        <p class="text-gray mb-2"><i class="fas fa-phone me-2 text-primary"></i>0889-8958-7027</p>
                        <p class="text-gray"><i class="fas fa-envelope me-2 text-primary"></i>carenest@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="landing-footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-3">
                    <h5>CareNest</h5>
                    <p>Sistem manajemen administrasi panti asuhan yang membantu pengelolaan data dan memudahkan donasi secara transparan.</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="https://www.tiktok.com/@mnetplus_original?is_from_webapp=1&sender_device=pc" target="_blank" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/wannaone.official?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/@WannaOneofficial" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="https://wa.me/6288989587027" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Link Cepat</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#tentang">Tentang Kami</a></li>
                        <li><a href="#data">Data Anak Panti</a></li>
                        <li><a href="#kebutuhan">Kebutuhan Panti</a></li>
                        <li><a href="#donasi">Donasi</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Lainnya</h5>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">Cara Berdonasi</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Kontak Kami</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i>JJl. Aurora Kencana No. 9, Sleman, Yogyakarta</p>
                    <p><i class="fas fa-phone me-2"></i>0889-8958-7027</p>
                    <p><i class="fas fa-envelope me-2"></i>carenest@gmail.com</p>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.12); margin-top: 3rem; margin-bottom: 1.5rem;">
            <div class="text-center text-white-50">© 2026 CareNest. All Rights Reserved.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
