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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .hero {
            position: relative;
            overflow: hidden;
            color: white;
            text-align: center;
            padding: 300px 0;
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

        footer {
            background-color: var(--primary-color);
            color: white;
            margin-top: auto;
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

        @media (max-width: 768px) {
            .hero {
                padding: 120px 0;
            }
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <a class="nav-link" href="{{ route('pelajar.dashboard') }}">Dashboard</a>
                    <a class="nav-link" href="{{ route('pelajar.paketSaya') }}">Paket Saya</a>
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
    </div>
    <br>
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <h1>Status Paket Saya</h1>
        <br>
        @if ($payments->isEmpty())
            <div class="alert alert-info">Belum ada paket yang Anda bayar.</div>
        @else
            <div class="row">
                @foreach ($payments as $payment)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="package-card">
                            <div class="package-header">
                                <h5 class="mb-0">{{ $payment->package_name }}</h5>
                            </div>
                            <div class="package-body">
                                <p class="mb-2"><strong>Kode Reservasi:</strong> {{ $payment->package_code }}</p>
                                <p class="mb-2"><strong>Tanggal Pembayaran:</strong>
                                    {{ $payment->created_at->format('d M Y') }}</p>
                                <p class="mb-2"><strong>Jumlah Bayar:</strong> Rp
                                    {{ number_format($payment->package->harga, 0, ',', '.') }}</p>
                                <span class="badge bg-{{ $payment->payment_status == 'Paid' ? 'success' : 'warning' }}">
                                    {{ $payment->payment_status }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>&copy; 2024 JourneyEase - Semua hak dilindungi</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
