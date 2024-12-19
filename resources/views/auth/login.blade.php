<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Studi Tour</title>
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

        .btn-success {
            background: linear-gradient(135deg, #42f584, #28a745);
            border: none;
            border-radius: 2rem;
            padding: 0.75rem 1.5rem;
            transition: transform 0.3s ease-in-out, background 0.3s;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #28a745, #1e7e34);
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

        .alert-success {
            border-radius: 1rem;
            padding: 1rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h2 class="text-center mb-4 text-primary">Login JourneyEase</h2>

            <!-- Pesan sukses jika login berhasil -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Pesan error jika login gagal -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('auth.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="Masukkan Email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Masukkan Password" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Login</button>
            </form>
            <div class="mt-3 text-center">
                <p>Belum memiliki akun? <a href="{{ route('register') }}" class="text-primary:hover">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</body>

</html>
