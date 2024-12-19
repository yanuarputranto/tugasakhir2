<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JourneyEase - Reservasi Studi Tour Pendidikan</title>
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
            padding: 500px 0;
            background: url('https://plus.unsplash.com/premium_photo-1677343210638-5d3ce6ddbf85?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center/cover;
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

        .btn-login {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            font-size: 1.2rem;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #217dbb;
        }

        .section-padding {
            padding: 80px 0;
        }

        .icon-feature {
            font-size: 3rem;
            display: inline-block;
            margin-bottom: 15px;
        }

        footer {
            background-color: var(--primary-color);
            color: white;
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
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#keunggulan">Keunggulan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#paket">Paket Tour</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
                </ul>
                <a href="{{ route('login') }}" class="btn-login ms-auto">Masuk</a>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <h1 class="display-4 mb-4">Learn, Explore, Experience</h1>
            <p class="lead mb-5">Platform Reservasi Studi Tour Terpercaya untuk Lembaga Pendidikan</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">Mulai Reservasi</a>
            <a href="#tentang" class="btn btn-outline-light btn-lg">Pelajari Lebih Lanjut</a>
        </div>
    </div>

    <!-- Tentang Section -->
    <section id="tentang" class="section-padding bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-4">Bagaimana Kami Bekerja</h2>
                    <div class="feature-box">
                        <h4>1. Admin Menyiapkan Paket</h4>
                        <p>Tim admin kami merancang paket studi tour yang komprehensif dan mendidik untuk berbagai
                            jenjang pendidikan.</p>
                    </div>
                    <div class="feature-box">
                        <h4>2. Pengajar Memilih</h4>
                        <p>Pengajar dapat memilih paket yang sesuai dengan kebutuhan kurikulum dan tujuan pendidikan.
                        </p>
                    </div>
                    <div class="feature-box">
                        <h4>3. Pelajar Reservasi & Konfirmasi</h4>
                        <p>Lakukan reservasi dan dapatkan konfirmasi dalam waktu singkat untuk perjalanan studi Anda.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="https://plus.unsplash.com/premium_photo-1677343210638-5d3ce6ddbf85?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8dHJhdmVsfGVufDB8fDB8fHww"
                        alt="Alur Kerja" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section id="keunggulan" class="section-padding" style="background-color: #f8f9fa;">
        <div class="container">
            <h2 class="text-center mb-5">Keunggulan JourneyEase</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="icon-feature">🌍</div>
                        <h4>Destinasi Berkualitas</h4>
                        <p>Paket tour dengan destinasi pilihan yang memiliki nilai edukasi tinggi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="icon-feature">📋</div>
                        <h4>Manajemen Mudah</h4>
                        <p>Sistem reservasi yang transparan dan mudah digunakan oleh pengajar.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="icon-feature">🛡️</div>
                        <h4>Keamanan Terjamin</h4>
                        <p>Proses pembayaran dan data peserta yang aman dan terlindungi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Tour Section -->
    <section id="paket" class="section-padding">
        <div class="container">
            <h2 class="text-center mb-5">Paket Studi Tour Tersedia</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card package-card h-100">
                        <img src="https://images.unsplash.com/photo-1684189162727-3b0fd73ba9e3?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mjh8fGJvcm9idWR1cnxlbnwwfHwwfHx8MA%3D%3D"
                            alt="Paket Sejarah" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Eksplorasi Sejarah Nusantara</h5>
                            <p class="card-text">
                                <strong>Destinasi:</strong> Yogyakarta, Borobudur, Prambanan<br>
                                <strong>Durasi:</strong> 5 hari<br>
                                <strong>Fokus:</strong> Sejarah dan Budaya
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card package-card h-100">
                        <img src="https://images.unsplash.com/photo-1570789210967-2cac24afeb00?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDd8fHxlbnwwfHx8fHw%3D"
                            alt="Paket Kelautan" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Studi Kelautan Indonesia</h5>
                            <p class="card-text">
                                <strong>Destinasi:</strong> Bali, Nusa Penida, Lombok<br>
                                <strong>Durasi:</strong> 7 hari<br>
                                <strong>Fokus:</strong> Ekosistem Laut
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card package-card h-100">
                        <img src="https://images.unsplash.com/photo-1637292872273-1fc99340ac04?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8YnJvbW98ZW58MHx8MHx8fDA%3D"
                            alt="Paket Ekologi" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Pegunungan Tropis</h5>
                            <p class="card-text">
                                <strong>Destinasi:</strong> Bromo, Semeru, Rinjanir<br>
                                <strong>Durasi:</strong> 6 hari<br>
                                <strong>Fokus:</strong> Konservasi Alam
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Section -->
    <section id="testimoni" class="section-padding" style="background-color: #f8f9fa;">
        <div class="container">
            <h2 class="text-center mb-5">Testimoni Pengguna</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="fst-italic">"Platform ini sangat membantu kami dalam merancang perjalanan studi
                                yang bermakna dan terstruktur."</p>
                            <div class="d-flex align-items-center mt-3">
                                <div>
                                    <h6 class="mb-0">Dr. Sarah Kusuma</h6>
                                    <small>Kepala Sekolah SMA Negeri 1</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="fst-italic">"Proses reservasi sangat mudah dan paket-paket yang disediakan sangat
                                berkualitas."</p>
                            <div class="d-flex align-items-center mt-3">
                                <div>
                                    <h6 class="mb-0">Bapak Hendro</h6>
                                    <small>Koordinator Studi Lapangan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="fst-italic">"Anak-anak menjadi lebih antusias belajar setelah mengikuti studi
                                tour melalui JourneyEase."</p>
                            <div class="d-flex align-items-center mt-3">
                                <div>
                                    <h6 class="mb-0">Ibu Kartini</h6>
                                    <small>Guru Biologi</small>
                                </div>
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
