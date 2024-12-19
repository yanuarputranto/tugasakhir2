<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
</head>

<body>

    <div class="container mt-5">
        <h2>Kelola Paket Wisata</h2>

        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ url('/admin/paket/create') }}" class="btn btn-success mb-3">Tambah Paket Baru</a>

        <!-- Tabel Paket Wisata -->
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Destinasi</th>
                    <th>Durasi</th>
                    <th>Urutan Destinasi</th>
                    <th>Geolokasi</th>
                    <th>QR Code</th>
                    <th>Foto</th>
                    <th>Harga</th> <!-- Kolom Harga Ditambahkan -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($packages as $index => $package)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $package->nama_paket }}</td>
                        <td>{{ $package->destinasi }}</td>
                        <td>{{ $package->durasi }} hari</td>
                        <td>{{ implode(', ', json_decode($package->urutan_destinasi)) }}</td>
                        <td>
                            <a href="https://maps.google.com/?q={{ $package->latitude }},{{ $package->longitude }}"
                                target="_blank" class="btn btn-info btn-sm">
                                Lihat Lokasi
                            </a>
                        </td>
                        <td>
                            @if ($package->qr_code)
                                <img src="{{ Storage::url($package->qr_code) }}" width="100" alt="QR Code">
                            @else
                                <span>QR Code belum dibuat</span>
                            @endif
                        </td>
                        <td>
                            @foreach (json_decode($package->foto, true) as $foto)
                                <img src="{{ Storage::url($foto) }}" alt="Foto Paket" width="150">
                            @endforeach
                        </td>
                        <td>
                            <!-- Menampilkan Harga Paket -->
                            Rp {{ number_format($package->harga, 0, ',', '.') }}
                            <!-- Menampilkan harga dengan format mata uang Indonesia -->
                        </td>
                        <td>
                            <a href="{{ route('kelola.paket.edit', $package->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kelola.paket.destroy', $package->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>
</body>

</html>
