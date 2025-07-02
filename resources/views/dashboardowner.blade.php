<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Owner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #f0f4ff, #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #0d6efd;
        }
        .navbar-brand, .nav-link, .btn-logout {
            color: white !important;
        }
        .btn-logout:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            background-color: #ffffffee;
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-3px);
        }
        .icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.4rem;
            margin-right: 12px;
        }
        .title-header {
            font-weight: 700;
            font-size: 1.2rem;
        }
        .btn {
            font-weight: 500;
            border-radius: 0.6rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Media Cendekia Muslim</a>
        <div class="ms-auto">
            <form action="{{ route('owner.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Konten -->
<div class="container py-5">
    <h1 class="mb-5 text-center text-primary">Dashboard Owner</h1>

    <div class="row g-4">

        <!-- Stok Buku -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-circle bg-primary">
                            <i class="bi bi-book"></i>
                        </div>
                        <span class="title-header">Stok Buku</span>
                    </div>
                    <a href="{{ route('owner.stok_buku') }}" class="btn btn-primary w-100">
                        <i class="bi bi-eye-fill me-1"></i> Lihat Stok Buku
                    </a>
                </div>
            </div>
        </div>

        <!-- Buku Terlaris -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-circle bg-success">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <span class="title-header">Buku Terlaris</span>
                    </div>
                    <a href="{{ route('owner.buku_terlaris') }}" class="btn btn-outline-success w-100">
                        <i class="bi bi-bar-chart-line-fill me-1"></i> Lihat Semua
                    </a>
                </div>
            </div>
        </div>

        <!-- Detail Penjualan -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-circle bg-warning text-dark">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <span class="title-header text-dark">Detail Penjualan</span>
                    </div>
                    <a href="{{ route('owner.detail_penjualan') }}" class="btn btn-outline-warning text-dark w-100">
                        <i class="bi bi-info-circle-fill me-1"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <!-- Laporan Penjualan -->
        <div class="col-md-12 col-lg-8">
            <div class="card border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-circle bg-dark">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <span class="title-header text-dark">Laporan Penjualan</span>
                    </div>
                    <div class="d-flex gap-3 flex-wrap">
                        <form action="{{ route('laporan.penjualan.pdf') }}" method="GET">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="bi bi-file-earmark-pdf-fill me-1"></i> PDF
                            </button>
                        </form>

                        <form method="GET" action="{{ route('owner.laporan_excel') }}">
                            <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                            <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-file-earmark-excel-fill me-1"></i> Excel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
