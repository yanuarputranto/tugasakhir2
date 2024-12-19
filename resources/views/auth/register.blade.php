<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Studi Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e2f0ff, #c7d2fe);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            background: #ffffff;
        }

        .form-control {
            border: none;
            background: #f8f9fa;
            border-radius: 2rem;
            padding: 1rem;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #495057;
        }

        .form-control:hover {
            background: #e9ecef;
        }

        .form-control:focus {
            background: #ffffff;
            border: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background: linear-gradient(135deg, #42a5f5, #007bff);
            border: none;
            border-radius: 2rem;
            padding: 0.75rem 1.5rem;
            transition: transform 0.3s ease-in-out, background 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #007bff, #0056b3);
            transform: translateY(-2px);
        }

        .text-primary {
            color: #007bff;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            font-size: 50px;
        }

        .text-primary:hover {
            color: #0056b3;
        }

        .input-group-text {
            border: none;
            background: #e2f0ff;
            border-radius: 2rem 0 0 2rem;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center mb-4 text-primary">Register akun JourneyEase</h2>
            <form action="{{ route('auth.register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="type" class="form-label">Daftar Sebagai</label>
                    <select name="type" id="type" class="form-select form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="pengajar">Pengajar</option>
                        <option value="pelajar">Pelajar</option>
                    </select>
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap"
                        required>
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                        required>
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Nomor Telepon"
                        required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea name="address" id="address" class="form-control" rows="3" placeholder="Alamat" required></textarea>
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                        required>
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                        placeholder="Konfirmasi Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div class="mt-3 text-center">
                <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-primary:hover">Login di sini</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>

</html>
