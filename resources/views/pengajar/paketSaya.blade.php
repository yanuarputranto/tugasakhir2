<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Saya - JourneyEase</title>
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
            padding: 200px 0;
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: var(--primary-color);
            color: white;
            margin-top: 150px;
            padding: 20px 0;
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
            <a class="navbar-brand text-white" href="#" style="font-size: 1.5rem; font-weight: 600;">JourneyEase</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <a class="nav-link" href="{{ route('pengajar.dashboard') }}">Dashboard</a>
                    <a class="nav-link" href="{{ route('pengajar.paketSaya') }}">Paket Saya</a>
                </ul>
                <a href="{{ route('pengajar.logout') }}" class="btn btn-outline-light ms-auto">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <h1 class="display-4 mb-4">DAFTAR PAKET YANG ANDA RESERVASI </h1>
            <p class="lead mb-5">Untuk Membatalkan atau mengubah Paket Silahkan Hubungi Admin</p>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-primary btn-lg me-3">WhatsApp Admin</a>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Paket Saya</h2>

        @if ($reservations->isEmpty())
            <p class="text-center">Anda belum memesan paket apa pun.</p>
        @else
            <div class="row">
                @foreach ($reservations as $reservation)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $reservation->package->nama_paket }}</h5>
                                <p class="card-text">
                                    <strong>Destinasi:</strong> {{ $reservation->package->destinasi }} <br>
                                    <strong>Durasi:</strong> {{ $reservation->package->durasi }} hari <br>
                                    <strong>Jumlah Peserta:</strong> {{ $reservation->number_of_participants }} orang
                                </p>
                                <a href="{{ route('pengajar.show', $reservation->package->id) }}"
                                    class="btn btn-primary mt-auto">Detail Paket</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; 2024 JourneyEase. Semua Hak Dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
