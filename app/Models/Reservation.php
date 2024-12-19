<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'package_id', 'teacher_name', 'reservation_date', 'number_of_participants', 'notes', 'reservation_code','school_name'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function pelajar()
    {
        return $this->belongsTo(Pelajar::class);
    }
}

