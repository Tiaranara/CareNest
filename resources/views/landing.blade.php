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
            --blue: #1e56ff;
            --indigo: #4b6bff;
            --green: #20c997;
            --orange: #ff7b6f;
            --dark: #1f2c44;
            --gray: #6c7a96;
            --surface: #ffffff;
            --surface-soft: #f7f9ff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(180deg, #f8f9ff 0%, #eef3ff 60%, #f7f9ff 100%);
            color: var(--dark);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.98);
            border-bottom: 1px solid rgba(31, 44, 68, 0.08);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1050;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--blue) !important;
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
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            color: #fff;
        }

        .navbar-nav {
            gap: 0.5rem;
        }

        .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            padding: 0.35rem 0.75rem;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--blue) !important;
        }

        .btn-primary,
        .btn-outline-primary {
            border-radius: 50px;
            padding: 0.8rem 1.6rem;
            font-weight: 600;
        }

        .btn-primary {
            box-shadow: 0 18px 40px rgba(30, 86, 255, 0.16);
        }

        .section {
            padding: 5rem 0;
        }

        .section-light {
            background: #fff;
        }

        .section-dark {
            background: #1f2c44;
        }

        .section-dark .section-heading h2,
        .section-dark .section-heading p {
            color: #fff;
        }

        .hero {
            padding: 4rem 0 3rem;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 380px;
            height: 380px;
            border-radius: 50%;
            background: rgba(30, 86, 255, 0.14);
            top: -100px;
            right: -120px;
            z-index: 0;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(75, 107, 255, 0.1);
            bottom: -70px;
            left: -80px;
            z-index: 0;
        }

        .hero-title {
            font-size: clamp(2.6rem, 5vw, 4rem);
            line-height: 1.03;
            letter-spacing: -0.04em;
        }

        .hero-text {
            color: var(--gray);
            font-size: 1.05rem;
            margin-top: 1.4rem;
            max-width: 620px;
            line-height: 1.8;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.75rem 1.1rem;
            border-radius: 999px;
            background: rgba(30, 86, 255, 0.08);
            color: var(--blue);
            font-weight: 700;
        }

        .hero-card {
            border-radius: 32px;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid rgba(30, 86, 255, 0.08);
            box-shadow: 0 30px 80px rgba(30, 86, 255, 0.08);
            min-height: 520px;
            position: relative;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.84) 0%, rgba(255,255,255,0.32) 40%, rgba(255,255,255,0.08) 100%);
            z-index: 1;
        }

        .hero-card-image {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(30,86,255,0.46), rgba(75,107,255,0.08)),
                url('https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
            z-index: 0;
        }

        .hero-card-body {
            position: relative;
            z-index: 2;
            padding: 2.5rem;
        }

        .hero-card-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .hero-card-text {
            color: var(--gray);
            line-height: 1.8;
        }

        .hero-stats {
            margin-top: 2rem;
            display: grid;
            gap: 1rem;
        }

        .hero-stat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.2rem;
            border-radius: 20px;
            background: rgba(255,255,255,0.92);
            box-shadow: 0 20px 40px rgba(30, 86, 255, 0.08);
        }

        .hero-stat span {
            color: var(--gray);
        }

        .hero-stat strong {
            color: var(--dark);
            font-weight: 700;
        }

        .feature-card,
        .data-card,
        .need-card,
        .contact-card {
            border-radius: 28px;
            background: var(--surface);
            border: 1px solid rgba(30, 86, 255, 0.08);
            box-shadow: 0 18px 60px rgba(30, 86, 255, 0.08);
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

        .feature-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .feature-text {
            color: var(--gray);
            line-height: 1.75;
        }

        .section-heading {
            margin-bottom: 2.75rem;
        }

        .section-heading h2 {
            font-weight: 800;
            letter-spacing: -0.04em;
        }

        .section-heading p {
            color: var(--gray);
        }

        .stat-card {
            padding: 1.55rem;
            text-align: center;
        }

        .stat-card .icon {
            width: 52px;
            height: 52px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            margin-bottom: 1rem;
            color: #fff;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .data-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 28px;
            border-top-right-radius: 28px;
        }

        .data-card-body,
        .need-card-body,
        .contact-card-body {
            padding: 1.5rem;
        }

        .data-card-body h5,
        .need-card-title {
            font-weight: 700;
            margin-bottom: 0.45rem;
        }

        .data-card-body small,
        .need-card-meta,
        .contact-card-body p {
            color: var(--gray);
        }

        .need-card {
            padding: 1.6rem;
        }

        .need-card-meta {
            font-size: 0.95rem;
            margin-top: 0.6rem;
        }

        .badge-status {
            font-size: 0.82rem;
            padding: 0.55rem 0.7rem;
            border-radius: 999px;
            font-weight: 700;
        }

        .badge-status.pending {
            background: #fff4e7;
            color: #b05628;
        }

        .badge-status.done {
            background: #e8faf0;
            color: #157347;
        }

        .contact-card {
            position: relative;
            overflow: hidden;
            padding: 2rem;
        }

        .contact-card::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(30, 86, 255, 0.14);
            top: -40px;
            right: -80px;
            z-index: 0;
        }

        .contact-card-body {
            position: relative;
            z-index: 1;
        }

        .landing-footer {
            background: #072564;
            color: #e7ecff;
            padding: 3rem 0 2rem;
        }

        .landing-footer h5 {
            color: #fff;
            margin-bottom: 1.2rem;
            font-weight: 700;
        }

        .landing-footer p,
        .landing-footer .footer-links a,
        .landing-footer .footer-links li {
            color: rgba(255, 255, 255, 0.78);
        }

        .landing-footer .footer-links li {
            margin-bottom: 0.9rem;
        }

        .landing-footer .footer-links a {
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .landing-footer .footer-links a:hover {
            color: white;
        }

        .landing-footer .d-flex a {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            color: white;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .landing-footer .d-flex a:hover {
            background: rgba(255, 255, 255, 0.16);
            transform: translateY(-2px);
        }

        .hero-wave {
            height: 100px;
            background: var(--blue);
            margin-top: -1px;
            position: relative;
            overflow: hidden;
        }

        .hero-wave svg {
            display: block;
            width: 100%;
            height: 100%;
        }

        @media (max-width: 991px) {
            .hero {
                padding-top: 3.5rem;
            }
        }

        @media (max-width: 767px) {
            .hero::before,
            .hero::after,
            .contact-card::before {
                display: none;
            }

            .hero-card {
                min-height: 420px;
            }

            .navbar-nav {
                flex-wrap: wrap;
                justify-content: center;
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

    <section class="hero">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <h1 class="hero-title">Peduli dan Berbagi Bersama <span style="color: var(--orange);">CareNest</span></h1>
                    <p class="hero-text">CareNest adalah platform digital untuk membantu pengalaman donasi menjadi lebih mudah dan menyenangkan. Anda dapat berkontribusi dan melihat dampak langsung dari setiap donasi Anda dengan transparan.</p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="#donasi" class="btn btn-primary">Donasi Sekarang</a>
                        <a href="#tentang" class="btn btn-outline-primary">Pelajari Lebih Lanjut</a>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 g-3 mt-5" style="display: none;">
                        <div class="col">
                            <div class="stat-card">
                                <div class="icon bg-blue"><i class="fas fa-child"></i></div>
                                <div class="stat-value">{{ $totalAnakPanti }}</div>
                                <p>Data Anak Panti</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="stat-card">
                                <div class="icon bg-green"><i class="fas fa-users"></i></div>
                                <div class="stat-value">{{ $totalDonatur }}</div>
                                <p>Data Donatur</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="stat-card">
                                <div class="icon bg-indigo"><i class="fas fa-hand-holding-heart"></i></div>
                                <div class="stat-value">Rp {{ number_format($totalDonasi ?? 0, 0, ',', '.') }}</div>
                                <p>Total Donasi</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="stat-card">
                                <div class="icon bg-orange"><i class="fas fa-box-open"></i></div>
                                <div class="stat-value">{{ $totalKebutuhan }}</div>
                                <p>Total Kebutuhan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-card">
                        <div class="hero-card-image"></div>
                        <div class="hero-card-body" style="display: none;">
                            <div class="hero-card-title">Pantau semua aktivitas panti dalam satu tampilan.</div>
                            <p class="hero-card-text">Lihat ringkasan data anak panti, donatur, dan catatan donasi dalam tampilan yang rapi. Setiap kebutuhan panti dapat dipantau agar dukungan tiba tepat waktu.</p>
                            <div class="hero-stats mt-4">
                                <div class="hero-stat"><span>Manajemen Anak</span><strong>{{ $totalAnakPanti }}</strong></div>
                                <div class="hero-stat"><span>Donatur Terdaftar</span><strong>{{ $totalDonatur }}</strong></div>
                                <div class="hero-stat"><span>Donasi Tercatat</span><strong>Rp {{ number_format($totalDonasi ?? 0, 0, ',', '.') }}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="hero-wave">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 Q360,0 720,40 T1440,40 L1440,120 L0,120 Z" fill="#1f2c44"></path>
        </svg>
    </div>

    <section class="section section-dark" id="fitur">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Fitur Utama CareNest</h2>
                <p>Fitur-fitur praktis yang mendukung pengelolaan anak panti dan donasi secara efisien.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card h-100">
                        <div class="icon bg-blue"><i class="fas fa-user-graduate"></i></div>
                        <div class="feature-title">Data Anak Panti</div>
                        <div class="feature-text">Kelola profil anak panti lengkap dengan usia, jenis kelamin, dan status.</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card h-100">
                        <div class="icon bg-green"><i class="fas fa-user-friends"></i></div>
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
                <h2>Data Anak Panti Terbaru</h2>
                <p>Menampilkan anak panti terbaru yang sudah didata oleh pengurus.</p>
            </div>
            <div class="row g-4">
                @forelse ($recentAnakPanti as $anak)
                    <div class="col-md-6 col-xl-3">
                        <div class="data-card">
                            <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=800&q=80" alt="Anak Panti">
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
    </section>

    <section class="section section-light" id="kebutuhan">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-7">
                    <div class="section-heading">
                        <h2>Kebutuhan Panti Prioritas</h2>
                        <p>Kebutuhan panti yang saat ini masih menunggu dukungan dan harus segera dipenuhi.</p>
                    </div>
                    <div class="row g-3">
                        @forelse ($unfulfilledKebutuhan as $kebutuhan)
                            <div class="col-12">
                                <div class="need-card">
                                    <div class="d-flex justify-content-between align-items-start flex-column flex-sm-row gap-3">
                                        <div>
                                            <div class="need-card-title">{{ $kebutuhan->nama_kebutuhan }}</div>
                                            <p class="need-card-meta">Jumlah: {{ $kebutuhan->jumlah_kebutuhan }}</p>
                                            <p class="need-card-meta">Pengajuan: {{ optional($kebutuhan->tanggal_pengajuan)->format('d M Y') }}</p>
                                        </div>
                                        <span class="badge-status pending">Belum Terpenuhi</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="feature-card text-center">
                                    <h3>Tidak ada kebutuhan yang belum terpenuhi</h3>
                                    <p>Semua kebutuhan panti sudah tercatat atau sudah dipenuhi.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-card" id="donasi">
                        <div class="contact-card-body">
                            <h2>Ingin bantu lebih cepat?</h2>
                            <p>Login ke sistem untuk mencatat donasi atau update kebutuhan panti secara langsung.</p>
                            <ul class="list-unstyled mt-4 mb-4">
                                <li class="mb-3"><strong>1.</strong> Masuk ke dashboard</li>
                                <li class="mb-3"><strong>2.</strong> Kelola data anak panti dan donatur</li>
                                <li><strong>3.</strong> Pastikan setiap kebutuhan segera terpenuhi</li>
                            </ul>
                            <a href="{{ route('login') }}" class="btn btn-primary">Masuk ke Dashboard</a>
                        </div>
                    </div>
                </div>
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
                        <p class="text-gray">Jl. Panti Asuhan No. 123, Jakarta</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="feature-card">
                        <h3>Kontak</h3>
                        <p class="text-gray mb-2"><i class="fas fa-phone me-2 text-primary"></i>0812-3456-7890</p>
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
                    <p>Sistem informasi manajemen panti asuhan yang membantu pengelolaan data dan memudahkan donasi secara transparan.</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
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
                    <p><i class="fas fa-map-marker-alt me-2"></i>Jl. Panti Asuhan No. 123, Jakarta</p>
                    <p><i class="fas fa-phone me-2"></i>0812-3456-7890</p>
                    <p><i class="fas fa-envelope me-2"></i>carenest@gmail.com</p>
                </div>
            </div>
            <div class="text-center text-white-50 mt-5">© 2024 CareNest. All Rights Reserved.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
