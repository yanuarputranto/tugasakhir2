<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Form Pembayaran</h1>
        <table class="table table-bordered">
            <tr>
                <th>Kode Reservasi</th>
                <td>{{ $reservation->reservation_code }}</td>
            </tr>
            <tr>
                <th>Nama Paket</th>
                <td>{{ $package->nama_paket }}</td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>Rp {{ number_format($package->harga, 0, ',', '.') }}</td>
            </tr>
        </table>

        <form action="{{ route('pelajar.payment.submit', $reservation->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="student_name" class="form-label">Nama Pelajar</label>
                <input type="text" class="form-control" id="student_name" name="student_name" value="{{ Auth::guard('pelajar')->user()->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukkan Kelas Anda" required>
            </div>
            <div class="mb-3">
                <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
                <input type="file" class="form-control" id="payment_proof" name="payment_proof" required>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Pembayaran</button>
            <a href="{{ route('pelajar.dashboard') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
