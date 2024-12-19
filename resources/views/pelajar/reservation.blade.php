<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi - JourneyEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --light-bg: #f4f6f7;
            --text-color: #333;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
            line-height: 1.6;
        }

        .hero {
            position: relative;
            height: 80vh;
            overflow: hidden;
        }

        .navbar-custom {
            background: transparent;
            transition: background-color 0.3s ease;
            padding: 1rem 0;
        }

        .navbar-custom.scrolled {
            background: var(--primary-color);
        }

        .navbar-nav {
            margin-left: auto;
        }

        .navbar-brand {
            color: white !important;
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: white !important;
        }

        .carousel-inner .carousel-item {
            height: 100vh;
        }

        .carousel-inner .carousel-item div {
            height: 100%;
            background-size: cover;
            background-position: center;
            width: 100%;
            filter: brightness(0.9);
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
        }

        .card {
            border-radius: 12px;
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .icon {
            color: var(--primary-color);
            font-size: 2rem;
            margin-right: 1rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        footer {
            background-color: var(--primary-color) !important;
            color: white !important;
            margin-top: 3rem;
            padding: 2rem 0;
        }

        .action-buttons {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
    </style>
    <script>
        document.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#" style="font-size: 1.5rem; font-weight: 600;">JourneyEase</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('pelajar.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pelajar.paketSaya') }}">Paket Saya</a></li>
                </ul>
                <form action="{{ route('pelajar.logout') }}" method="POST" class="d-inline ms-auto">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div id="heroCarousel" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">
                @php
                    $photos = json_decode($package->foto, true); // Ambil array foto dari JSON
                @endphp
                @foreach ($photos as $index => $photo)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }} h-100">
                        <div style="background-image: url('{{ Storage::url($photo) }}');"></div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>



    <div class="container mt-5">
        <h1 class="text-center mb-5" style="font-weight: bold; color: #2c3e50;">Detail Reservasi</h1>

        <!-- Container -->
        <div class="row g-4">
            <!-- Kode Reservasi -->
            <div class="col-lg-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon me-3 text-primary">
                            <i class="bi bi-key"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1" style="font-weight: 600;">Kode Reservasi</h5>
                            <p class="card-text text-muted">{{ $reservation->reservation_code }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nama Pengajar -->
            <div class="col-lg-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon me-3 text-primary">
                            <i class="bi bi-person"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1" style="font-weight: 600;">Nama Pengajar</h5>
                            <p class="card-text text-muted">{{ $reservation->teacher_name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nama Instansi -->
            <div class="col-lg-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon me-3 text-primary">
                            <i class="bi bi-building"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1" style="font-weight: 600;">Nama Instansi</h5>
                            <p class="card-text text-muted">{{ $reservation->school_name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nama Paket -->
            <div class="col-lg-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon me-3 text-primary">
                            <i class="bi bi-bag"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1" style="font-weight: 600;">Nama Paket</h5>
                            <p class="card-text text-muted">{{ $package->nama_paket }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Destinasi -->
            <div class="col-lg-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon me-3 text-primary">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1" style="font-weight: 600;">Destinasi</h5>
                            <p class="card-text text-muted">{{ $package->destinasi }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lokasi -->
            <div class="col-lg-6">
                <div class="card shadow border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon me-3 text-primary">
                            <i class="bi bi-pin-map"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1" style="font-weight: 600;">Lokasi</h5>
                            <a href="https://maps.google.com/?q={{ $package->latitude }},{{ $package->longitude }}"
                                target="_blank" class="btn btn-primary btn-sm">Lihat Lokasi</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- QR Code -->
            <div class="col-12">
                <div class="card shadow-lg border-0 text-center p-5">
                    <div class="card-body">
                        <h5 class="card-title mb-3" style="font-weight: bold; color: #2c3e50;">AR WISATA</h5>
                        @if ($package->qr_code)
                            <img src="{{ Storage::url($package->qr_code) }}" class="img-fluid rounded"
                                alt="QR Code" style="max-width: 300px; margin: 0 auto;">
                        @else
                            <p class="text-danger">QR Code belum dibuat</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Harga -->
            <div class="col-lg-12">
                <div class="card shadow border-0 h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title mb-2" style="font-weight: 600;">Harga</h5>
                        <p class="display-5 text-success" style="font-weight: bold;">Rp
                            {{ number_format($package->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-5 d-flex justify-content-between">
            <a href="{{ route('pelajar.payment', $reservation->id) }}" class="btn btn-primary btn-lg">Ikut Study
                Tour</a>
            <a href="{{ route('pelajar.dashboard') }}" class="btn btn-secondary btn-lg">Kembali</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>&copy; 2024 JourneyEase - Platform Reservasi Studi Tour</p>
            <p class="small">Hak Cipta Dilindungi Undang-Undang</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
