<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JourneyEase - Dashboard Pengajar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --primary-color: #2c3e50;
            --secondary-color: #2c3e50;
            --background-color: #f4f6f7;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--primary-color);
            line-height: 1.6;
        }

        .hero {
            position: relative;
            overflow: hidden;
            color: white;
            text-align: center;
            padding: 400px 0;
            background: url('https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center/cover;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(44, 62, 80, 0.7);
        }

        .hero-content {
            position: relative;
            z-index: 2;
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

        .nav-link {
            color: white !important;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #e0e0e0 !important;
        }

        .section-padding {
            padding: 80px 0;
        }

        .feature-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .icon-feature {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .package-card {
            transition: all 0.3s ease;
        }

        .package-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        footer {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
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
            <a class="navbar-brand text-white" href="#" style="font-size: 1.5rem; font-weight: 600;">JourneyEase</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#paket">Paket Tersedia</a></li>
                    <li class="nav-item"><a class="nav-link" href="#aktivitas">Aktivitas</a></li>
                    <a class="nav-link" href="{{ route('pengajar.paketSaya') }}">Paket Saya</a>
                </ul>
                <form action="{{ route('pengajar.logout') }}" method="POST" class="d-inline ms-auto">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <h1 class="display-4 mb-4">Selamat Datang, Pengajar!</h1>
            <p class="lead mb-5">Kelola Perjalanan Studi Anda dengan Mudah dan Efisien</p>
            <a href="#paket" class="btn btn-primary btn-lg me-3">Pilih Paket</a>
            <a href="#aktivitas" class="btn btn-outline-light btn-lg">Lihat Aktivitas</a>
        </div>
    </div>

    <!-- Dashboard Section -->
    <section id="dashboard" class="section-padding bg-white">
        <div class="container">
            <h2 class="text-center mb-5">Ringkasan Dashboard</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="icon-feature">📦</div>
                        <h4>Paket Aktif</h4>
                        <p class="h2">3</p>
                        <small>Total paket yang sedang berjalan</small>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="icon-feature">👥</div>
                        <h4>Peserta Terdaftar</h4>
                        <p class="h2">120</p>
                        <small>Jumlah peserta pada paket Anda</small>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="icon-feature">🗓️</div>
                        <h4>Jadwal Mendatang</h4>
                        <p class="h2">2</p>
                        <small>Jumlah perjalanan yang akan datang</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Tersedia Section -->
    <section id="paket" class="section-padding">
        <div class="container">
            <h2 class="text-center mb-5">Paket Studi Tour Tersedia</h2>
            <div class="row g-4"> <!-- Tambahkan row dan gap antar kartu -->
                @foreach ($packages as $package)
                    <div class="col-lg-4 col-md-6"> <!-- Lebih lebar: 3 kartu per baris di layar besar -->
                        <div class="card h-100 shadow">
                            @php
                                $photos = json_decode($package->foto, true);
                                $firstPhoto = reset($photos); // Ambil foto pertama
                            @endphp
                            <img src="{{ Storage::url($firstPhoto) }}" alt="Foto Paket" class="card-img-top"
                                style="object-fit: cover; height: 300px;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $package->nama_paket }}</h5>
                                <p class="card-text">
                                    <strong>Destinasi:</strong> {{ $package->destinasi }} <br>
                                    <strong>Durasi:</strong> {{ $package->durasi }} hari <br>
                                    <strong>Urutan Destinasi:</strong>
                                    {{ implode(', ', json_decode($package->urutan_destinasi)) }}
                                </p>
                                <a href="{{ route('pengajar.show', $package->id) }}" class="btn btn-primary mt-auto">
                                    Detail Paket
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    <!-- Aktivitas Section -->
    <section id="aktivitas" class="section-padding" style="background-color: #f8f9fa;">
        <div class="container">
            <h2 class="text-center mb-5">Aktivitas Terkini</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Reservasi Baru</h5>
                            <p class="card-text">Paket Sejarah Nusantara telah direservasi oleh 25 peserta</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">10 Des 2024</small>
                                <span class="badge bg-primary">Reservasi</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Pembayaran Dikonfirmasi</h5>
                            <p class="card-text">Pembayaran untuk Studi Kelautan Indonesia telah dikonfirmasi</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">8 Des 2024</small>
                                <span class="badge bg-success">Pembayaran</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Jadwal Diperbarui</h5>
                            <p class="card-text">Jadwal untuk Pegunungan Tropis telah diperbarui</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">5 Des 2024</small>
                                <span class="badge bg-warning">Jadwal</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
