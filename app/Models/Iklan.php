<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{   
    protected $fillable = [
        'id_user','id_jenis','judul', 'deskripsi', 'jam_buka', 'jam_tutup', 'hari_kerja', 'provinsi', 'kabupaten', 'kecamatan', 'desa', 'alamat', 'gambar', 'bayar', 'tanggal_bayar', 'kode_pos', 'nohp', 'email'
    ];

    public function gambar()
    {
        return $this->hasMany(Gambar::class);
    }

    use HasFactory;
}