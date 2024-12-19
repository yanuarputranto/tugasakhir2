<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Tambah Paket Wisata</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Tambah Paket Wisata</h2>
        <form action="{{ route('kelola.paket.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_paket" class="form-label">Nama Paket</label>
                <input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
            </div>
            <div class="mb-3">
                <label for="destinasi" class="form-label">Destinasi</label>
                <input type="text" class="form-control" id="destinasi" name="destinasi" required>
            </div>
            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi</label>
                <select class="form-control" id="durasi" name="durasi" required>
                    <option value="1">1 Hari</option>
                    <option value="2">2 Hari</option>
                    <option value="3">3 Hari</option>
                    <option value="4">4 Hari</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude" required>
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude" required>
            </div>
            <div id="destinations-container">
                <label for="urutan_destinasi" class="form-label">Urutan Destinasi</label>
                <div class="destination-group">
                    <input type="text" class="form-control mb-2" name="urutan_destinasi[]" placeholder="Destinasi 1" required>
                    <input type="text" class="form-control mb-2" name="urutan_destinasi[]" placeholder="Destinasi 2" required>
                </div>
            </div>
            <script>
                document.getElementById('durasi').addEventListener('change', function() {
                    const days = parseInt(this.value);
                    const container = document.getElementById('destinations-container');
                    container.innerHTML = '';
                    for (let day = 1; day <= days; day++) {
                        for (let dest = 1; dest <= 2; dest++) {
                            const input = document.createElement('input');
                            input.type = 'text';
                            input.className = 'form-control mb-2';
                            input.name = 'urutan_destinasi[]';
                            input.placeholder = `Hari ${day} - Destinasi ${dest}`;
                            input.required = true;
                            container.appendChild(input);
                        }
                    }
                });
            </script>
            <!-- Kolom untuk Link Website Resmi -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" required>
            </div>

            <div class="mb-3">
                <label for="website_official" class="form-label">Website Resmi</label>
                <input type="text" class="form-control" id="website_official" name="website_official" placeholder="https://example.com" value="{{ old('website_official') }}">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="fotos[]" class="form-control" multiple>

            </div>
            <button type="submit" class="btn btn-primary">Simpan Paket</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
