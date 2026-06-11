<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - CareNest</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --success: #27ae60;
            --danger: #e74c3c;
            --warning: #f39c12;
        }

        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary) 0%, #34495e 100%);
            padding: 20px 0;
            position: fixed;
            width: 250px;
            left: 0;
            top: 0;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar .sidebar-nav a {
            white-space: normal;
        }

        .sidebar .sidebar-nav li {
            width: 100%;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            padding: 1rem 2rem;
        }

        .navbar-toggler {
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--primary);
        }

        .navbar-toggler:hover {
            background: rgba(52, 152, 219, 0.08);
        }

        .navbar-text {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin 0.3s ease;
        }

        .main-content.no-sidebar {
            margin-left: 0;
        }


        .sidebar-brand h4 {
            margin: 0;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .sidebar-brand p {
            margin: 5px 0 0 0;
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            margin: 0;
        }

        .sidebar-nav a {
            display: block;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: var(--secondary);
        }

        .sidebar-nav i {
            width: 20px;
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin 0.3s ease;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            padding: 1rem 2rem;
        }

        .navbar-brand {
            font-weight: bold;
            color: var(--primary) !important;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, #34495e 100%);
            color: white;
            border: none;
            font-weight: bold;
            border-radius: 16px 16px 0 0 !important;
        }

        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 8px 16px;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-1px);
        }

        .stat-card {
            border: none !important;
            border-radius: 20px;
            background: white;
            color: #2c3e50;
            font-weight: 700;
            height: 160px;
            display: flex;
            align-items: stretch;
            padding: 0;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-card .card-body {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 22px;
            position: relative;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 32px rgba(0, 0, 0, 0.12);
        }

        .stat-card i {
            font-size: 1.35rem;
            opacity: 0.95;
        }

        .stat-card .stat-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
        }

        .stat-card .stat-icon {
            min-width: 60px;
            min-height: 60px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-card.anak .stat-icon {
            background: #3b82f6;
            color: white;
        }

        .stat-card.donatur .stat-icon {
            background: #10b981;
            color: white;
        }

        .stat-card.donasi .stat-icon {
            background: #f59e0b;
            color: white;
        }

        .stat-card.kebutuhan .stat-icon {
            background: #ef4444;
            color: white;
        }

        .stat-card p {
            margin: 0 0 8px 0;
            font-size: 0.8rem;
            opacity: 0.75;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            color: #4b5563;
        }

        .stat-card h4 {
            margin: 0;
            font-size: 2.2rem;
            font-weight: 800;
            color: #111827;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        .table-responsive {
            border-radius: 12px;
            border: 1px solid #edf2f9;
        }

        .table {
            background: white;
            margin-bottom: 0;
        }

        .table thead {
            background-color: #f8f9fc;
        }

        .table thead th {
            color: #5e6e82;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #edf2f9;
            padding: 1.1rem 1rem;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 1rem;
            color: #495057;
            border-bottom: 1px solid #edf2f9;
        }

        .table tbody tr:hover {
            background-color: #f8f9fc;
        }

        .form-control, .form-select {
            border-radius: 5px;
            border: 1px solid #e0e0e0;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .pagination {
            margin: 0;
            gap: 4px;
        }

        .pagination .page-link {
            border-radius: 10px;
            padding: 0.45rem 0.9rem;
            min-width: 40px;
            text-align: center;
            color: var(--primary);
            border-color: #dfe3e8;
            transition: all 0.2s ease;
        }

        .pagination .page-item {
            margin: 0 2px;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--secondary);
            border-color: var(--secondary);
            color: white;
            box-shadow: 0 3px 8px rgba(52, 152, 219, 0.3);
        }

        .pagination .page-link:hover {
            border-color: var(--secondary);
            color: var(--secondary);
            background-color: #eaf4fb;
        }

        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background-color: #f8f9fa;
            border-color: #e9ecef;
        }

        .pagination-wrapper {
            width: 100%;
            padding-top: 0.75rem;
            border-top: 1px solid #f1f5f9;
            margin-top: 0.5rem;
        }

        .pagination-summary {
            color: #6c757d;
            font-size: 0.875rem;
            white-space: nowrap;
            margin-bottom: 0;
        }

        .pagination-nav {
            min-width: 220px;
        }

        .pagination-nav .pagination {
            justify-content: flex-end;
        }

        .badge {
            padding: 8px 12px;
            font-size: 0.85rem;
        }

        .main-content .container-lg {
            max-width: 1180px;
        }

        @media (max-width: 992px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                margin-bottom: 20px;
                box-shadow: none;
            }

            .main-content {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 1rem;
            }

            .navbar-text {
                font-size: 0.95rem;
            }

            .sidebar-nav a {
                padding: 12px 15px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    @if(auth()->user()->isAdmin())
        <!-- Sidebar -->
        <aside id="sidebarMenu" class="sidebar collapse d-lg-block">
            <div class="sidebar-brand">
                <h4><i class="fas fa-heart"></i> CareNest</h4>
                <p>Manajemen Panti Asuhan</p>
            </div>

            <ul class="sidebar-nav">
                <li><a href="{{ route('dashboard') }}" class="{{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('anak-panti.index') }}" class="{{ str_starts_with(Route::currentRouteName(), 'anak-panti') ? 'active' : '' }}"><i class="fas fa-children"></i> Data Anak Panti</a></li>
                <li><a href="{{ route('donatur.index') }}" class="{{ str_starts_with(Route::currentRouteName(), 'donatur') ? 'active' : '' }}"><i class="fas fa-users"></i> Data Donatur</a></li>
                <li><a href="{{ route('donasi.index') }}" class="{{ str_starts_with(Route::currentRouteName(), 'donasi') ? 'active' : '' }}"><i class="fas fa-hand-holding-heart"></i> Data Donasi</a></li>
                <li><a href="{{ route('kebutuhan-panti.index') }}" class="{{ str_starts_with(Route::currentRouteName(), 'kebutuhan-panti') ? 'active' : '' }}"><i class="fas fa-list"></i> Kebutuhan Panti</a></li>
                <li><a href="{{ route('reports.donasi') }}" class="{{ str_starts_with(Route::currentRouteName(), 'reports') ? 'active' : '' }}"><i class="fas fa-file-pdf"></i> Laporan</a></li>
                <li style="border-top: 1px solid rgba(255, 255, 255, 0.1); margin-top: 20px; padding-top: 20px;">
                    <form action="{{ route('logout') }}" method="POST" style="padding: 0 20px;">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </aside>
    @endif

    <!-- Main Content -->
    <div class="main-content {{ auth()->user()->isAdmin() ? '' : 'no-sidebar' }}">
        <div class="container-lg">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    @yield('scripts')
</body>
</html>
