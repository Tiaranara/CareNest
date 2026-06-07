<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CareNest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --blue: #1e56ff;
            --indigo: #4b6bff;
            --green: #20c997;
            --dark: #1f2c44;
            --gray: #6c7a96;
            --surface: #ffffff;
            --surface-soft: #f4f7ff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(180deg, #eef3ff 0%, #f7f9ff 60%, #ffffff 100%);
            color: var(--dark);
        }

        .page-wrapper {
            min-height: calc(100vh - 96px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem 1rem;
        }

        .auth-card {
            width: 100%;
            max-width: 480px;
            border-radius: 32px;
            background: var(--surface);
            border: 1px solid rgba(30, 86, 255, 0.08);
            box-shadow: 0 28px 90px rgba(30, 86, 255, 0.08);
            overflow: hidden;
        }

        .auth-header {
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
        }

        .auth-header .brand-icon {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.2);
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .auth-header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            letter-spacing: -0.04em;
        }

        .auth-header p {
            color: rgba(255,255,255,0.85);
            margin-bottom: 0;
            line-height: 1.7;
        }

        .auth-body {
            padding: 2.5rem 2rem 1.75rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.6rem;
            font-size: 0.95rem;
            color: var(--dark);
        }

        .form-control {
            border: 1px solid #d8e1f5;
            border-radius: 16px;
            padding: 0.95rem 1rem;
            background: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 0.15rem rgba(30, 86, 255, 0.12);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--blue);
            font-size: 1rem;
        }

        .input-group {
            position: relative;
        }

        .input-group .form-control {
            padding-left: 3.2rem;
        }

        .btn-auth {
            width: 100%;
            border-radius: 999px;
            padding: 0.95rem 1rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            border: none;
            color: white;
            box-shadow: 0 15px 35px rgba(30, 86, 255, 0.24);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 45px rgba(30, 86, 255, 0.28);
        }

        .footer {
            background: rgba(255,255,255,0.96);
            border-top: 1px solid rgba(31, 44, 68, 0.08);
            padding: 1.5rem 0;
            text-align: center;
            color: var(--gray);
        }

        .footer a {
            color: var(--gray);
            text-decoration: none;
            margin: 0 0.65rem;
            font-weight: 600;
        }

        .footer a:hover {
            color: var(--blue);
        }

        .auth-footer-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: var(--gray);
        }

        .auth-footer-link a {
            color: var(--blue);
            text-decoration: none;
            font-weight: 700;
        }

        @media (max-width: 576px) {
            .page-wrapper {
                padding: 2rem 1rem 1rem;
            }

            .auth-header {
                padding: 2rem 1.5rem;
            }

            .auth-body {
                padding: 2rem 1.5rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <main class="page-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <div class="brand-icon"><i class="fas fa-home"></i></div>
                <h1>CareNest</h1>
                <p>Masuk ke sistem manajemen panti asuhan dengan tampilan yang bersih dan intuitif.</p>
            </div>
            <div class="auth-body">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong><i class="fas fa-exclamation-circle"></i> Terjadi kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label" for="email">Email</label>
                        <div class="input-group">
                            <i class="fas fa-envelope input-icon"></i>
                            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus placeholder="Masukkan email">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Masukkan password">
                        </div>
                    </div>
                    <button type="submit" class="btn-auth">Masuk Sekarang</button>
                </form>
                <p class="auth-footer-link">Belum punya akun? <a href="/register">Daftar sekarang</a></p>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
