<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Kelola Pemesanan</h2>
        <table id="myTable" class="display">
            <thead class="display">
                <tr>
                    <th>#</th>
                    <th>Paket</th>
                    <th>Kode Reservasi</th>
                    <th>Pengajar</th>
                    <th>Instansi</th>
                    <th>Tanggal Reservasi</th>
                    <th>Jumlah Peserta</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reservation->package->nama_paket }}</td>
                    <td>{{ $reservation->reservation_code }}</td>
                    <td>{{ $reservation->teacher_name }}</td>
                    <td>{{ $reservation->school_name }}</td>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>{{ $reservation->number_of_participants }}</td>
                    <td>{{ $reservation->notes }}</td>
                    <td>
                        <!-- Tombol Detail -->
                        <a href="{{ route('kelola.paket', $reservation->package->id) }}" class="btn btn-info btn-sm">Detail</a>

                        <!-- Tombol Batalkan -->
                        <form action="{{ route('kelola.pemesanan.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                        </form>

                        <!-- Tombol Kelola Peserta Studi Tour -->
                        <a href="{{ route('admin.kelolaPeserta', $reservation->reservation_code) }}" class="btn btn-primary btn-sm">Kelola Peserta</a>

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
