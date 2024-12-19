<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h1 class="h4">Kelola Peserta</h1>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="text-secondary">Kode Reservasi: <span class="text-dark fw-bold">{{ $reservation->reservation_code }}</span></h5>
                    <h5 class="text-secondary">Nama Paket: <span class="text-dark fw-bold">{{ $reservation->package->nama_paket }}</span></h5>
                </div>

                @if($payments->isEmpty())
                    <div class="alert alert-warning text-center" role="alert">
                        Belum ada peserta untuk reservasi ini.
                    </div>
                @else
                    <div class="table-responsive">
                        <table id="myTable" class="display">
                            <thead class="display">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pelajar</th>
                                    <th>Kelas</th>
                                    <th>Status Pembayaran</th>
                                    <th>Bukti Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->student_name }}</td>
                                    <td>{{ $payment->kelas }}</td>
                                    <td>
                                        <span class="badge bg-{{ $payment->payment_status == 'Paid' ? 'success' : 'warning' }}">
                                            {{ $payment->payment_status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($payment->payment_proof)
                                        <a href="{{ Storage::url($payment->payment_proof) }}" target="_blank" class="btn btn-sm btn-info">
                                            Lihat Bukti
                                        </a>
                                        @else
                                        <span class="text-danger">Belum Upload</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('kelola.pemesanan') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>
</body>
</html>
