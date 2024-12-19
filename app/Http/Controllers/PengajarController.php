<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Reservation;
use App\Models\Pengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PengajarController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register'); // Tampilkan form register
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pengajars,email',
            'password' => 'required|min:6|confirmed', // Validasi password
        ]);

        $pengajar = new Pengajar();
        $pengajar->name = $validated['name'];
        $pengajar->email = $validated['email'];
        $pengajar->password = Hash::make($validated['password']);
        $pengajar->save();

        return redirect()->route('login')->with('success', 'Registrasi sebagai Pengajar berhasil.');
    }

    // Menampilkan halaman login pengajar
    public function showLoginForm()
    {
        return view('pengajar.login');
    }

    // Proses login pengajar
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('pengajar')->attempt($credentials)) {
            return redirect()->route('pengajar.dashboard')->with('success', 'Login berhasil.');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Menampilkan semua paket
    public function index()
    {
        $packages = Package::all(); // Ambil semua paket dari database
        return view('pengajar.dashboard', compact('packages')); // Kirim data ke view
    }

    // Menampilkan detail paket
    public function showPackageDetail($id)
    {
        $package = Package::findOrFail($id); // Mengambil data paket berdasarkan ID
        return view('pengajar.show', compact('package')); // Kirim data ke view
    }

    // Menyimpan reservasi
    public function reservePackage(Request $request, $id)
{
    // Validasi input termasuk nama sekolah
    $validated = $request->validate([
        'number_of_participants' => 'required|integer|min:1', // Validasi jumlah peserta
        'reservation_date' => 'required|date', // Validasi tanggal reservasi
        'school_name' => 'required|string|max:255', // Validasi nama sekolah
        'notes' => 'nullable|string', // Catatan opsional
    ]);

    // Ambil paket berdasarkan ID
    $package = Package::findOrFail($id);

    // Ambil nama pengajar yang sedang login
    $teacher_name = Auth::guard('pengajar')->user()->name;

    // Buat kode reservasi unik
    $reservation_code = strtoupper(Str::random(8)); // Misalnya, kode reservasi 8 karakter acak

    // Menyimpan reservasi baru
    Reservation::create([
        'package_id' => $package->id,
        'teacher_name' => $teacher_name, // Menyimpan nama pengajar
        'reservation_date' => $validated['reservation_date'],
        'number_of_participants' => $validated['number_of_participants'],
        'school_name' => $validated['school_name'], // Menyimpan nama sekolah
        'notes' => $validated['notes'], // Catatan opsional
        'reservation_code' => $reservation_code, // Menyimpan kode reservasi
    ]);

    // Redirect setelah sukses membuat reservasi
    return redirect()->route('pengajar.show', $package->id)->with('success', 'Reservasi berhasil dibuat. Kode Reservasi: ' . $reservation_code);
}
public function paketSaya()
{
    $pengajar = Auth::guard('pengajar')->user(); // Pengajar yang sedang login

    // Ambil reservasi berdasarkan pengajar
    $reservations = Reservation::where('teacher_name', $pengajar->name)
        ->with('package') // Pastikan relasi dengan `package` di model Reservation sudah ada
        ->get();

    return view('pengajar.paketSaya', compact('reservations'));
}

}
