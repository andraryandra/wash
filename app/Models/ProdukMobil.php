<?php

namespace App\Models;

use App\Models\KategoriMobil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukMobil extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function kategoriMobil()
    {
        return $this->belongsTo(KategoriMobil::class, 'kategori_mobil_id', 'id');
    }
}
