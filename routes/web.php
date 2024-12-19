<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\PelajarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Halaman Login Umum
Route::get('/login', function () {
    return view('auth.login'); // Halaman login
})->name('login');

// Proses Login Umum
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    // Cek login untuk Pengajar
    if (Auth::guard('pengajar')->attempt($credentials)) {
        return redirect()->route('pengajar.dashboard')->with('success', 'Login sebagai Pengajar berhasil.');
    }

    // Cek login untuk Pelajar
    elseif (Auth::guard('pelajar')->attempt($credentials)) {
        return redirect()->route('pelajar.dashboard')->with('success', 'Login sebagai Pelajar berhasil.');
    }

    return back()->withErrors(['email' => 'Email atau password salah.']);
})->name('auth.login');

// Rute untuk Register
Route::get('/register', function () {
    return view('auth.register'); // Halaman register
})->name('register');

// Proses Register
Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed', // Pastikan ada konfirmasi password
        'type' => 'required|in:pengajar,pelajar', // Validasi tipe
    ]);

    if ($request->input('type') === 'pengajar') {
        $pengajar = new \App\Models\Pengajar();
        $pengajar->name = $validated['name'];
        $pengajar->email = $validated['email'];
        $pengajar->password = bcrypt($validated['password']);
        $pengajar->save();

        return redirect()->route('login')->with('success', 'Registrasi sebagai Pengajar berhasil.');
    } elseif ($request->input('type') === 'pelajar') {
        $pelajar = new \App\Models\Pelajar();
        $pelajar->name = $validated['name'];
        $pelajar->email = $validated['email'];
        $pelajar->password = bcrypt($validated['password']);
        $pelajar->save();

        return redirect()->route('login')->with('success', 'Registrasi sebagai Pelajar berhasil.');
    }

    return back()->withErrors(['type' => 'Jenis pengguna tidak valid.']);
})->name('auth.register');

// Rute untuk Pengajar
Route::prefix('pengajar')->group(function () {
    Route::get('/register', [PengajarController::class, 'showRegisterForm'])->name('pengajar.register');
    Route::post('/register', [PengajarController::class, 'register']);
    Route::get('/login', [PengajarController::class, 'showLoginForm'])->name('pengajar.login');
    Route::post('/login', [PengajarController::class, 'login']);

    // Rute Logout untuk Pengajar
    Route::post('/logout', function () {
        Auth::guard('pengajar')->logout(); // Logout dari guard pengajar
        return redirect()->route('login'); // Kembali ke halaman login umum
    })->name('pengajar.logout');

    Route::middleware('auth:pengajar')->group(function () {
        Route::get('/dashboard', [PengajarController::class, 'index'])->name('pengajar.dashboard');
        Route::get('/package/{id}', [PengajarController::class, 'showPackageDetail'])->name('pengajar.show');
    Route::post('/package/{id}/reserve', [PengajarController::class, 'reservePackage'])->name('pengajar.reserve.package');
        Route::get('/pengajar/paket-saya', [PengajarController::class, 'paketSaya'])->name('pengajar.paketSaya');
    });
});

// Rute untuk Pelajar
Route::prefix('pelajar')->group(function () {
    Route::get('/register', [PelajarController::class, 'showRegisterForm'])->name('pelajar.register');
    Route::post('/register', [PelajarController::class, 'register']);
    Route::get('/login', [PelajarController::class, 'showLoginForm'])->name('pelajar.login');
    Route::post('/login', [PelajarController::class, 'login']);
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login'); // Mengarahkan kembali ke halaman login umum
    })->name('pelajar.logout');


    // Rute setelah login berhasil
    Route::middleware('auth:pelajar')->group(function () {
        Route::get('/dashboard', [PelajarController::class, 'dashboard'])->name('pelajar.dashboard');
        Route::get('/pemesanan', [PelajarController::class, 'pemesanan'])->name('pelajar.pemesanan');
        // Route::get('/pelajar/reservasi', [PelajarController::class, 'createReservation'])->name('pelajar.reservasi');
        Route::get('/pelajar/reservasi/{id}', [PelajarController::class, 'showReservationDetail'])->name('pelajar.reservasi');
        Route::get('/pelajar/payment/{id}', [PelajarController::class, 'showPaymentForm'])->name('pelajar.payment');
        Route::post('/pelajar/payment/{id}', [PelajarController::class, 'submitPayment'])->name('pelajar.payment.submit');
        Route::get('/pelajar/paket-saya', [PelajarController::class, 'paketSaya'])->name('pelajar.paketSaya');


    });
});
// Rute Admin
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/admin/login');
})->name('logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('auth')->name('admin.dashboard');




// Kelola Paket Admin
Route::middleware('auth')->group(function () {
    Route::get('/admin/paket', [AdminController::class, 'kelolaPaket'])->name('kelola.paket');

    Route::get('/admin/pemesanan', [AdminController::class, 'kelolaPemesanan'])->name('kelola.pemesanan');

    // Menampilkan form untuk tambah paket (menggunakan GET)
    Route::get('/admin/paket/create', [AdminController::class, 'createPackage'])->name('kelola.paket.create');

    // Menyimpan paket baru (menggunakan POST)
    Route::post('/admin/paket', [AdminController::class, 'storePackage'])->name('kelola.paket.store');

    // Update paket setelah form disubmit (menggunakan PUT)
    Route::put('/admin/paket/{id}', [AdminController::class, 'updatePackage'])->name('kelola.paket.update');

    // Hapus paket (menggunakan DELETE)
    Route::delete('/admin/paket/{id}', [AdminController::class, 'destroyPackage'])->name('kelola.paket.destroy');

    Route::get('/packages/{id}', [PackageController::class, 'show']);
    Route::get('/admin/paket/{id}/qrcode', [AdminController::class, 'showQrCode'])->name('kelola.paket.qrcode');


    // Rute untuk mengelola peserta studi tour
Route::get('/admin/pemesanan/{reservationId}/kelola-peserta', [AdminController::class, 'manageParticipants'])->name('admin.manageParticipants');
// Rute untuk menghapus reservasi
Route::delete('/admin/pemesanan/{id}', [AdminController::class, 'destroyReservation'])->name('kelola.pemesanan.destroy');
Route::get('/admin/kelola-peserta', [AdminController::class, 'kelolaPeserta'])->name('admin.kelolaPeserta');
Route::get('/admin/kelola-peserta/{reservationCode}', [AdminController::class, 'kelolaPeserta'])->name('admin.kelolaPeserta');
Route::get('/admin/paket/{id}/edit', [AdminController::class, 'edit'])->name('kelola.paket.edit');
Route::put('/admin/paket/{id}', [AdminController::class, 'update'])->name('kelola.paket.update');




});



