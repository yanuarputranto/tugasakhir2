<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'kelas',
        'package_code',
        'package_name',
        'payment_status',
        'payment_proof'
    ];

    public function reservation()
{
    return $this->belongsTo(Reservation::class, 'reservation_code', 'reservation_code'); // Sesuaikan nama kolom jika berbeda
}

public function package()
{
    // Gunakan package_code untuk mencari relasi
    return $this->belongsTo(Package::class, 'package_name', 'nama_paket');
    // Pastikan 'kode' adalah kolom di tabel packages yang sesuai
}

}
