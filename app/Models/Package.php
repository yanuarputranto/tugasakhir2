<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'nama_paket',
        'destinasi',
        'durasi',
        'latitude',
        'longitude',
        'urutan_destinasi',
        'foto',
        'qr_code',
        'harga',  // Pastikan harga ada di sini
        'website_official',
    ];

    protected $casts = [
        'urutan_destinasi' => 'array',
    ];

    public function payments()
{
    return $this->hasMany(Payment::class);
}

}
