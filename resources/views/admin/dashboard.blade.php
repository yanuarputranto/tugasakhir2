<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card:hover {
            transform: scale(1.02);
            transition: 0.3s ease;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin JourneyEase</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Welcome, Admin!</h2>
        <p class="text-center">Here you can manage everything related to study tour packages and reservations.</p>

        <!-- Manage Packages Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Kelola Paket Wisata</h5>
                    </div>
                    <div class="card-body">
                        <p>Manage the study tour packages that are available for teachers to reserve.</p>
                        <a href="{{ route('kelola.paket') }}" class="btn btn-primary">Kelola Paket</a>
                        <a href="{{ route('kelola.paket.create') }}" class="btn btn-success">Tambah Paket Baru</a>
                    </div>
                </div>
            </div>

            <!-- Manage Reservations Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h5>Kelola Pemesanan</h5>
                    </div>
                    <div class="card-body">
                        <p>View and manage reservations made by teachers for various packages.</p>
                        <a href="{{ route('kelola.pemesanan') }}" class="btn btn-warning">Kelola Pemesanan</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Dashboard Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5>Dashboard Overview</h5>
                    </div>
                    <div class="card-body">
                        <p>Welcome to the admin dashboard where you can oversee and manage all aspects of the study tour system.</p>
                        <ul>
                            <li>Manage available study tour packages.</li>
                            <li>Review and approve reservations made by teachers.</li>
                            <li>Confirm payment status once students complete their transactions.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
