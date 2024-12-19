<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JourneyEase</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .hero {
            position: relative;
            overflow: hidden;
            color: white;
            text-align: center;
            padding: 400px 0;
            background:
                url('https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center/cover;
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
            color: var(--secondary-color) !important;
        }


        .section-padding {
            padding: 80px 0;
        }

        .package-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .package-card:hover {
            transform: translateY(-5px);
        }

        .package-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .package-body {
            padding: 20px;
        }

        .search-result-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .search-result-card:hover {
            transform: translateY(-5px);
        }

        .search-result-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
        }

        .search-result-body {
            padding: 20px;
        }

        footer {
            background-color: var(--primary-color);
            color: white;
            margin-top: auto;
            padding: 20px 0;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 0;
            height: 42px;
            width: 42px;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .btn-primary i {
            font-size: 1.2rem;
        }

        .navbar-toggler {
            color: white;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
    <script>
        document.addEventListener('scroll', function() {
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
            <a class="navbar-brand text-white" href="#">JourneyEase</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="dashboard">Dashboard</a></li>
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
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <h1 class="display-4 mb-4">Selamat Datang, {{ $pelajar->name }}</h1>
            <p class="lead mb-5">Temukan Pemesanan Anda dengan Kode Reservasi</p>
            <!-- Form Pencarian -->
            <form method="GET" action="{{ route('pelajar.dashboard') }}" class="mt-3">
                <div class="input-group">
                    <input type="text" name="search_code" class="form-control"
                        placeholder="Cari dengan kode reservasi" value="{{ request()->search_code }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Dashboard Pelajar -->
    <div class="container mt-5">
        @if (!request()->has('search_code'))
            <!-- Bagian Paket Studi Tour Tersedia -->
            <section id="paket" class="section-padding">
                <div class="container">
                    <h2 class="text-center mb-5">Paket Studi Tour Tersedia</h2>
                    <div class="row g-4">
                        @if ($packages->isNotEmpty())
                            <!-- Cek jika $packages ada isinya -->
                            @foreach ($packages as $package)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card h-100 shadow">
                                        @php
                                            $photos = json_decode($package->foto, true);
                                            $firstPhoto = !empty($photos) ? reset($photos) : null; // Ambil foto pertama atau null jika tidak ada foto
                                        @endphp

                                        @if ($firstPhoto)
                                            <img src="{{ Storage::url($firstPhoto) }}" alt="Foto Paket"
                                                class="card-img-top" style="object-fit: cover; height: 300px;">
                                        @else
                                            <img src="path/to/default-image.jpg" alt="Foto Paket" class="card-img-top"
                                                style="object-fit: cover; height: 300px;">
                                        @endif

                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $package->nama_paket }}</h5>
                                            <p class="card-text">
                                                <strong>Destinasi:</strong> {{ $package->destinasi }} <br>
                                                <strong>Durasi:</strong> {{ $package->durasi }} hari <br>
                                                <strong>Urutan Destinasi:</strong>
                                                {{ implode(', ', json_decode($package->urutan_destinasi)) }}
                                            </p>

                                            @if (auth()->user()->role == 'pengajar')
                                                <!-- Hanya pengajar yang bisa memilih paket -->
                                                <a href="{{ route('pengajar.show', $package->id) }}"
                                                    class="btn btn-primary mt-auto">
                                                    Pilih Paket
                                                </a>
                                            @else
                                                <!-- Pelajar melihat detail dan menghubungi dosen -->
                                                <p class="mt-auto text-center">
                                                    Hanya pengajar yang bisa memilih
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">Tidak ada paket wisata tersedia saat ini.</p>
                        @endif
                    </div>

                </div>
            </section>
        @else
            <!-- Bagian Pencarian -->
            @if (!request('search_code'))
                <p class="text-center mt-4">Silakan masukkan kode reservasi untuk melakukan pencarian.</p>
            @elseif($reservations->isEmpty())
                <p class="text-center mt-4">Tidak ada reservasi yang ditemukan untuk kode
                    "{{ request('search_code') }}".</p>
            @else
                <h3 class="mt-4 mb-4">Hasil Pencarian:</h3>
                <div class="row">
                    @foreach ($reservations as $reservation)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="search-result-card">
                                <div class="search-result-header">
                                    <h5 class="mb-0">{{ $reservation->reservation_code }}</h5>
                                </div>
                                <div class="search-result-body">
                                    <p class="mb-2"><strong>Paket:</strong> {{ $reservation->package->nama_paket }}
                                    </p>
                                    <p class="mb-2"><strong>Tanggal Mulai:</strong>
                                        {{ $reservation->reservation_date }}</p>
                                    <p class="mb-2"><strong>Durasi:</strong> {{ $reservation->package->durasi }} hari
                                    </p>
                                    <p class="mb-3"><strong>Jumlah Peserta:</strong>
                                        {{ $reservation->number_of_participants }}</p>
                                    <a href="{{ route('pelajar.reservasi', $reservation->id) }}"
                                        class="btn btn-primary w-100">Reservasi</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>

    <!-- Footer -->
    <footer class="py-4">
        <div class="container text-center">
            <p>&copy; 2024 JourneyEase - Platform Reservasi Studi Tour</p>
            <p class="small">Hak Cipta Dilindungi Undang-Undang</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
