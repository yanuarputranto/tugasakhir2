<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Paket - JourneyEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
        }

        .carousel-item img {
            max-height: 600px; /* Set a maximum height for the images */
            width: 100%; /* Ensure the image takes the full width */
            object-fit: cover; /* Ensure the images cover the area without distortion */
        }


        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #007bff; /* Change the color of the icons */
            border-radius: 50%; /* Rounded icons */
        }

        .package-details {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #343a40;
            color: white;
        }

        .btn-reservasi {
            background-color: #007bff;
            color: white;
        }

        .btn-reservasi:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">JourneyEase</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengajar.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('pengajar.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link text-white">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Detail Paket -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div id="photoCarousel" class="carousel slide" data-bs-ride="false"> <!-- Disable auto slide -->
                    <div class="carousel-inner">
                        @foreach (json_decode($package->foto, true) as $index => $foto)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ Storage::url($foto) }}" class="d-block" alt="Foto Paket">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#photoCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#photoCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Selanjutnya</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 package-details">
                <h3>{{ $package->nama_paket }}</h3>
                <p><strong>Destinasi:</strong> {{ $package->destinasi }}</p>
                <p><strong>Durasi:</strong> {{ $package->durasi }} hari</p>
                <p><strong>Harga:</strong> Rp{{ number_format($package->harga, 0, ',', '.') }}</p>
                <p><strong>Deskripsi:</strong> {{ $package->deskripsi }}</p>
                <p><strong>Urutan Destinasi:</strong> {{ implode(', ', json_decode($package->urutan_destinasi)) }}</p>
            </div>
        </div>

        <!-- Formulir Reservasi -->
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">Formulir Reservasi</div>
            <div class="card-body">
                <form action="{{ route('pengajar.reserve.package', $package->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="school_name" class="form-label">Nama Instansi</label>
                        <input type="text" class="form-control" id="school_name" name="school_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="number_of_participants" class="form-label">Jumlah Peserta</label>
                        <input type="number" name="number_of_participants" id="number_of_participants"
                            class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="reservation_date" class="form-label">Tanggal Mulai Reservasi</label>
                        <input type="date" name="reservation_date" id="reservation_date" class="form-control"
                            required>
                        <small class="text-muted">Durasi otomatis disesuaikan dengan paket ini ({{ $package->durasi }}
                            hari).</small>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Catatan (Opsional)</label>
                        <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-reservasi">Lakukan Reservasi</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-center py-3 mt-5">
        &copy; 2024 JourneyEase | All Rights Reserved
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
