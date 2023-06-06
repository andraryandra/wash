<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingCuci extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function karyawan()
    {
        return $this->belongsTo(User::class, 'karyawan_id', 'id');
    }

    public function statusKaryawan()
    {
        return $this->hasMany(StatusKaryawan::class, 'karyawan_id', 'id');
    }

    public function kategoriMobil()
    {
        return $this->belongsTo(KategoriMobil::class, 'kategori_mobil_id', 'id');
    }
}
