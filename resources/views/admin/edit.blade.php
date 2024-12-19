<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Edit Paket Wisata</h2>

        <!-- Menampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Edit Paket -->
        <form action="{{ route('kelola.paket.update', $package->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_paket" class="form-label">Nama Paket</label>
                <input type="text" class="form-control" id="nama_paket" name="nama_paket"
                    value="{{ $package->nama_paket }}" required>
            </div>

            <div class="mb-3">
                <label for="destinasi" class="form-label">Destinasi</label>
                <input type="text" class="form-control" id="destinasi" name="destinasi"
                    value="{{ $package->destinasi }}" required>
            </div>

            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi (Hari)</label>
                <input type="number" class="form-control" id="durasi" name="durasi" value="{{ $package->durasi }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ $package->harga }}"
                    required>
            </div>

            <script>
                document.getElementById('durasi').addEventListener('input', function(e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });

                document.getElementById('harga').addEventListener('input', function(e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            </script>


            <div class="mb-3">
                <label for="existing_fotos" class="form-label">Foto Saat Ini</label>
                <div>
                    @foreach (json_decode($package->foto, true) as $foto)
                        <img src="{{ Storage::url($foto) }}" alt="Foto Paket" width="150">
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="fotos" class="form-label">Ganti Foto Baru</label>
                <input type="file" name="fotos[]" class="form-control" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ url('/admin/paket') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
