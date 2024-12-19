<?php

// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Tambahkan ini untuk impor Auth
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Database\Seeders\AdminUserSeeder;
use App\Models\Reservation; // Add this line
use App\Models\Payment;

class AdminController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek kredensial login menggunakan guard `web`
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect ke dashboard setelah login berhasil
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil.');
        }

        // Jika gagal login, kembali ke halaman login dengan error
        return back()->with('error', 'Email atau password salah.')->withInput($request->only('email'));
    }

    // Dashboard Admin - menampilkan paket dan pemesanan
    public function dashboard()
    {
        $packages = Package::all();  // Ambil semua paket wisata
        return view('admin.dashboard', compact('packages'));
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin.login')->with('success', 'Logout berhasil.');
    }

    public function kelolaPaket()
    {
        // Ambil semua paket wisata yang ada
        $packages = Package::all();
        return view('admin.kelolaPaket', compact('packages'));
    }

    // Method untuk menampilkan form tambah paket
    public function createPackage() // Ganti nama metode menjadi createPackage
    {
        return view('admin.createPaket');
    }

    // Method untuk menyimpan paket baru
    public function storePackage(Request $request)
{
    try {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'destinasi' => 'required|string|max:255',
            'durasi' => 'required|integer|min:1',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'urutan_destinasi' => 'required|array',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website_official' => 'nullable|url',
            'harga' => 'required|numeric|min:0',
        ]);

        $package = new Package();
        $package->nama_paket = $request->nama_paket;
        $package->destinasi = $request->destinasi;
        $package->durasi = $request->durasi;
        $package->latitude = $request->latitude;
        $package->longitude = $request->longitude;
        $package->urutan_destinasi = json_encode($request->urutan_destinasi);
        $package->harga = $request->harga;

        // Simpan foto jika ada
    $fotos = [];
    if ($request->hasFile('fotos')) {
        foreach ($request->file('fotos') as $file) {
            $fotos[] = $file->store('packages', 'public'); // Simpan file ke storage
        }
    }
    $package->foto = json_encode($fotos); // Simpan sebagai JSON

        if ($request->website_official) {
            $qrCodePath = 'qr_codes/' . uniqid() . '.svg';
            QrCode::format('svg')->size(200)->generate($request->website_official, storage_path("app/public/{$qrCodePath}"));
            $package->qr_code = $qrCodePath;
        }

        $success = $package->save();

        if ($success) {
            return redirect()->route('kelola.paket')->with('success', 'Paket berhasil ditambahkan.');
        } else {
            return back()->with('error', 'Gagal menyimpan paket.');
        }
    } catch (\Exception $e) {
        // Tangkap dan tampilkan exception
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    // Method untuk menampilkan daftar paket
    public function indexPaket()
    {
        $packages = Package::all();  // Mengambil semua data paket
        return view('admin.kelolaPaket', compact('packages'));
    }
    public function editPackage($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.edit', compact('package'));
    }

    public function updatePackage(Request $request, $id)
    {
        dd($request);
        $package = Package::findOrFail($id);

        // $validated = $request->validate([
        //     'nama_paket' => 'required',
        //     'destinasi' => 'required',
        //     'jumlah_peserta' => 'required|integer',
        //     'durasi' => 'required|integer',
        //     'urutan_destinasi' => 'required|array',
        //     'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        // $package->nama_paket = $validated['nama_paket'];
        // $package->destinasi = $validated['destinasi'];
        // $package->jumlah_peserta = $validated['jumlah_peserta'];
        // $package->durasi = $validated['durasi'];
        // $package->urutan_destinasi = json_encode($validated['urutan_destinasi']);

         // Ambil foto lama
        // $existingFotos = json_decode($package->foto, true) ?? [];

        // // Tambahkan foto baru
        // if ($request->hasFile('fotos')) {
        //     foreach ($request->file('fotos') as $file) {
        //         $existingFotos[] = $file->store('packages', 'public');
        //     }
        // }

        // $package->foto = json_encode($existingFotos);

        // $package->save();

        // return redirect()->route('kelola.paket')->with('success', 'Paket wisata berhasil diperbarui.');
    }

      // Kelola Pemesanan Admin
      public function kelolaPemesanan()
      {
          // Mengambil semua pemesanan
          $reservations = Reservation::with('package')->get();
          return view('admin.kelolaPemesanan', compact('reservations'));
      }

    public function destroyPackage($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return redirect()->route('kelola.paket')->with('success', 'Paket wisata berhasil dihapus.');
    }

    public function destroyReservation($id)
{
    // Mencari reservasi berdasarkan ID
    $reservation = Reservation::findOrFail($id);

    // Menghapus reservasi
    $reservation->delete();

    // Mengarahkan kembali ke halaman kelola pemesanan dengan pesan sukses
    return redirect()->route('kelola.pemesanan')->with('success', 'Reservasi berhasil dihapus.');
}

public function kelolaPeserta($reservationCode)
{
    // Ambil peserta berdasarkan kode reservasi
    $payments = Payment::where('package_code', $reservationCode)->get();

    // Ambil detail reservasi (opsional, jika ingin menampilkan detail reservasi)
    $reservation = Reservation::where('reservation_code', $reservationCode)->first();

    return view('admin.kelolaPeserta', compact('payments', 'reservation'));
}

public function edit($id)
{
    // Ambil data paket berdasarkan ID
    $package = Package::findOrFail($id);
    //dd($package);
    // Arahkan ke halaman edit dengan data paket
    return view('admin.edit', compact('package'));
}

public function update(Request $request, $id)
{
    // Ambil data paket berdasarkan ID
    $package = Package::findOrFail($id);

    // Validasi input
    $request->validate([
        'nama_paket' => 'required|string|max:255',
        'destinasi' => 'required|string|max:255',
        'durasi' => 'required|integer|min:1',
        'harga' => 'required|numeric|min:0',
        'fotos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Validasi setiap file dalam array
    ]);

    // Update data paket
    $package->nama_paket = $request->nama_paket;
    $package->destinasi = $request->destinasi;
    $package->durasi = $request->durasi;
    $package->harga = $request->harga;

    // Tangani unggahan file foto
    if ($request->hasFile('fotos')) {
        $fotos = []; // Array untuk menyimpan path file
        foreach ($request->file('fotos') as $file) {
            $fotos[] = $file->store('public/fotos'); // Simpan file di direktori `public/fotos`
        }
        $package->foto = json_encode($fotos); // Simpan path file sebagai JSON
    }

    // Simpan perubahan ke database
    $package->save();

    // Redirect dengan pesan sukses
    return redirect('/admin/paket')->with('success', 'Paket berhasil diperbarui.');
}


}
