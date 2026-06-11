<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - CareNest</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300;0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700;0,14..32,800;0,14..32,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #f4f7ff;
            color: #1f2c44;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        /* ── ANIMATED BACKGROUND ── */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.55;
            animation: float 12s ease-in-out infinite;
        }

        .orb-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #3498db, #1e56ff);
            top: -150px; left: -150px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, #4b6bff, #1e56ff);
            bottom: -100px; right: -100px;
            animation-delay: -4s;
        }

        .orb-3 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, #3498db, #06b6d4);
            top: 50%; left: 60%;
            animation-delay: -8s;
        }

        .orb-4 {
            width: 220px; height: 220px;
            background: radial-gradient(circle, #a5b4fc, #818cf8);
            top: 70%; left: 10%;
            animation-delay: -2s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(30px, -40px) scale(1.05); }
            66%       { transform: translate(-20px, 30px) scale(0.97); }
        }

        .bg-grid {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image:
                linear-gradient(rgba(30, 86, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(30, 86, 255, 0.03) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        /* ── MAIN LAYOUT ── */
        .page {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1040px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .card {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-radius: 28px;
            overflow: hidden;
            border: 1px solid rgba(30, 86, 255, 0.08);
            box-shadow:
                0 0 0 1px rgba(30, 86, 255, 0.05),
                0 30px 70px rgba(30, 86, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
            animation: cardIn 0.7s cubic-bezier(0.22,1,0.36,1) both;
        }

        @keyframes cardIn {
            from { opacity: 0; transform: translateY(32px) scale(0.97); }
            to   { opacity: 1; transform: none; }
        }

        /* ── LEFT: BRANDING ── */
        .brand-side {
            background: linear-gradient(165deg, #0f172a 0%, #1e3a8a 50%, #1e56ff 100%);
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            color: #fff;
        }

        .brand-side::before {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(52, 152, 219, 0.15);
            bottom: -80px; left: -80px;
        }

        .brand-side::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(75, 107, 255, 0.1);
            top: -60px; right: -60px;
        }

        .brand-top { position: relative; z-index: 1; }

        .logo {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 3rem;
            color: #020202;
        }

        .logo-box {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #1e56ff, #3498db);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
            box-shadow: 0 8px 24px rgba(30, 86, 255, 0.35);
        }

        .brand-headline {
            font-size: 1.9rem;
            font-weight: 900;
            line-height: 1.2;
            letter-spacing: -0.05em;
            margin-bottom: 0.9rem;
            color: #181818;
        }

        .brand-headline span {
            background: linear-gradient(90deg, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-sub {
            color: rgba(252, 244, 244, 0.7);
            font-size: 0.88rem;
            line-height: 1.7;
            margin-bottom: 2rem;
        }



        .brand-foot {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.73rem;
            position: relative;
            z-index: 1;
        }

        /* ── RIGHT: FORM ── */
        .form-side {
            background: rgba(29, 28, 28, 0.95);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #1f2c44;
        }

        .form-title {
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            margin-bottom: 0.35rem;
            color: #1f2c44;
        }

        .form-subtitle {
            color: #6c7a96;
            font-size: 0.875rem;
            margin-bottom: 1.75rem;
        }

        .error-box {
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.25);
            border-radius: 12px;
            padding: 0.85rem 1rem;
            color: #b91c1c;
            font-size: 0.82rem;
            margin-bottom: 1.25rem;
        }

        .error-box ul { padding-left: 1.1rem; margin-top: 0.3rem; }

        .field { margin-bottom: 1rem; }

        .field label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: #4b5563;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-bottom: 0.45rem;
        }

        .field-wrap { position: relative; }

        .field-wrap .fi {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.875rem;
            pointer-events: none;
            z-index: 2;
            transition: color 0.2s;
        }

        .field-wrap input {
            width: 100%;
            background: rgba(241, 242, 244, 0.02);
            border: 1px solid rgba(30, 86, 255, 0.12);
            border-radius: 12px;
            padding: 0.8rem 1rem 0.8rem 2.7rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            color: #1f2c44;
            outline: none;
            transition: border-color 0.25s, background 0.25s, box-shadow 0.25s;
        }

        .field-wrap input::placeholder { color: #f3eaea; }

        .field-wrap input:focus {
            border-color: #1e56ff;
            background: rgba(236, 238, 243, 0.04);
            box-shadow: 0 0 0 3px rgba(30, 86, 255, 0.15);
        }

        .field-wrap:focus-within .fi { color: #1e56ff; }
        .field-wrap input.is-invalid { border-color: rgba(239, 68, 68, 0.6); }

        .pw-btn {
            position: absolute;
            right: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 0.25rem;
            font-size: 0.85rem;
            z-index: 3;
            transition: color 0.2s;
        }

        .pw-btn:hover { color: #1e56ff; }
        .pw-btn:focus { outline: none; }
        .has-pw input { padding-right: 3rem; }

        .btn-submit {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 0.9rem 1rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.92rem;
            font-weight: 700;
            color: #0e0d0d;
            background: linear-gradient(135deg, #1e56ff 0%, #1a4cd6 50%, #1134a6 100%);
            box-shadow: 0 8px 24px rgba(30, 86, 255, 0.35);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
            margin-top: 0.5rem;
            letter-spacing: 0.02em;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.12), transparent);
            opacity: 0;
            transition: opacity 0.2s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(30, 86, 255, 0.5);
        }

        .btn-submit:hover::before { opacity: 1; }
        .btn-submit:active { transform: translateY(0); }

        .divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.25rem 0;
            color: #9ca3af;
            font-size: 0.73rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(30, 86, 255, 0.08);
        }

        .foot-link {
            text-align: center;
            font-size: 0.86rem;
            color: #6b7280;
        }

        .foot-link a {
            color: #1e56ff;
            font-weight: 700;
            text-decoration: none;
        }

        .foot-link a:hover { text-decoration: underline; }

        /* ── RESPONSIVE ── */
        @media (max-width: 820px) {
            .card { grid-template-columns: 1fr; }
            .brand-side { padding: 2.5rem 2rem 2rem; }
            .brand-headline { font-size: 1.5rem; }
            .feature-list { display: none; }
            .brand-foot { display: none; }
            .form-side { padding: 2.5rem 2rem; }
        }

        @media (max-width: 480px) {
            .page { padding: 1rem; }
            .brand-side { padding: 2rem 1.5rem 1.5rem; }
            .form-side { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

<div class="bg-canvas">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
    <div class="orb orb-4"></div>
</div>
<div class="bg-grid"></div>

<div class="page">
    <div class="card">

        <!-- BRAND SIDE -->
        <div class="brand-side">
            <div class="brand-top">
                <div class="logo">
                    <div class="logo-box"><i class="fas fa-heart"></i></div>
                    CareNest
                </div>
                <div class="brand-headline">
                    Bergabung &<br>mulai <span>berkontribusi</span>
                </div>
                <p class="brand-sub">
                    Daftar akun untuk membantu pengelolaan panti asuhan secara digital — transparan, mudah, dan terpercaya.
                </p>

            </div>
            <div class="brand-foot">© 2026 CareNest. All rights reserved.</div>
        </div>

        <!-- FORM SIDE -->
        <div class="form-side">
            <div class="form-title">Buat akun baru ✨</div>
            <div class="form-subtitle">Isi data di bawah untuk mendaftar.</div>

            @if ($errors->any())
                <div class="error-box">
                    <strong><i class="fas fa-circle-exclamation"></i> Perbaiki data berikut:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/register">
                @csrf

                <div class="field">
                    <label for="name">Nama Lengkap</label>
                    <div class="field-wrap">
                        <i class="fas fa-user fi"></i>
                        <input id="name" type="text" name="name"
                            class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ old('name') }}" required autofocus
                            placeholder="Nama lengkap Anda">
                    </div>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <div class="field-wrap">
                        <i class="fas fa-envelope fi"></i>
                        <input id="email" type="email" name="email"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                            value="{{ old('email') }}" required
                            placeholder="nama@email.com">
                    </div>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="field-wrap has-pw">
                        <i class="fas fa-lock fi"></i>
                        <input id="password" type="password" name="password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                            required placeholder="Minimal 8 karakter">
                        <button type="button" class="pw-btn" data-target="password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="field">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="field-wrap has-pw">
                        <i class="fas fa-lock fi"></i>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            required placeholder="Ulangi password Anda">
                        <button type="button" class="pw-btn" data-target="password_confirmation">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                </button>
            </form>

            <div class="divider">atau</div>

            <p class="foot-link">Sudah punya akun? <a href="/login">Masuk di sini</a></p>
        </div>

    </div>
</div>

<script>
    document.querySelectorAll('.pw-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            if (!input) return;
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            this.innerHTML = show ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
        });
    });
</script>
</body>
</html>
