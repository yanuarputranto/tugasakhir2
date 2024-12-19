<?php

namespace App\Http\Controllers;

use App\Models\Pelajar;
use App\Models\Reservation;
use App\Models\PaketStudiTour;
use App\Models\Payment;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PelajarController extends Controller
{
    // Menampilkan halaman register
    public function showRegisterForm()
    {
        return view('auth.register'); // Tampilkan form register
    }

    // Proses register pelajar
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pelajars,email',
            'password' => 'required|min:6|confirmed', // Validasi password
        ]);

        // Membuat akun pelajar baru
        $pelajar = new Pelajar();
        $pelajar->name = $validated['name'];
        $pelajar->email = $validated['email'];
        $pelajar->password = Hash::make($validated['password']);
        $pelajar->save();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi sebagai Pelajar berhasil.');
    }

    // Menampilkan halaman login pelajar
    public function showLoginForm()
    {
        return view('pelajar.login');
    }

    // Proses login pelajar
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('pelajar')->attempt($credentials)) {
            return redirect()->route('pelajar.dashboard')->with('success', 'Login berhasil.');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function Dashboard(Request $request)
{
    $packages = Package::all(); // Ambil semua paket
    $pelajar = Auth::guard('pelajar')->user(); // Mendapatkan data pelajar yang sedang login

    // Jika tidak ada paket, set packages menjadi collection kosong
    if ($packages->isEmpty()) {
        $packages = collect();
    }

    // Lanjutkan seperti biasa
    $query = Reservation::with('package'); // Ambil data reservasi beserta relasinya

    // Jika ada pencarian berdasarkan kode reservasi
    if ($request->has('search_code') && !empty($request->search_code)) {
        $query->where('reservation_code', 'like', '%' . $request->search_code . '%');
    }

    // Eksekusi query
    $reservations = $query->get();

    // Jika tidak ada data, buat notifikasi
    if ($reservations->isEmpty()) {
        $message = 'Tidak ada data reservasi ditemukan untuk kode: ' . $request->search_code;
        return view('pelajar.dashboard', compact('pelajar', 'reservations', 'packages'))->with('message', $message);
    }

    // Jika ada data, tetap tampilkan halaman dengan data
    return view('pelajar.dashboard', compact('pelajar', 'reservations', 'packages'));
}



    // Menampilkan pemesanan untuk pelajar
    public function pemesanan()
    {
        // Ambil data pemesanan pelajar yang sedang login
        $reservations = Reservation::where('pelajar_id', Auth::guard('pelajar')->id())->get();

        // Kirim data pemesanan ke view pemesanan
        return view('pelajar.pemesanan', compact('reservations'));
    }

    public function showReservationDetail($id)
{
    $reservation = Reservation::with('package')->findOrFail($id);

    return view('pelajar.reservation', [
        'reservation' => $reservation,
        'package' => $reservation->package
    ]);
}

public function showPaymentForm($id)
{
    $reservation = Reservation::findOrFail($id);
    $package = $reservation->package;

    return view('pelajar.payment', compact('reservation', 'package'));
}

public function submitPayment(Request $request, $id)
{
    $validated = $request->validate([
        'student_name' => 'required|string', // Nama pelajar
        'kelas' => 'required|string', // Kelas pelajar
        'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Bukti pembayaran
    ]);

    // Ambil data reservasi dan paket
    $reservation = Reservation::findOrFail($id);
    $package = $reservation->package;

    // Simpan bukti pembayaran
    $path = $request->file('payment_proof')->store('payments', 'public');

    // Simpan data pembayaran ke tabel payments
    Payment::create([
        'student_name' => $validated['student_name'],
        'kelas' => $validated['kelas'],
        'package_code' => $reservation->reservation_code, // Kode paket
        'package_name' => $package->nama_paket, // Nama paket
        'payment_proof' => $path,
        'payment_status' => 'Paid',
    ]);

    return redirect()->route('pelajar.paketSaya')->with('success', 'Pembayaran berhasil dan data telah disimpan.');
}
public function paketSaya()
{
    $studentName = auth()->user()->name;

    $payments = Payment::where('student_name', $studentName)
        ->with('package')
        ->get();

    return view('pelajar.paket-saya', compact('payments'));
}



}
