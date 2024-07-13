<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    protected $fillable = ['path','path_dwt', 'iklan_id'];

    public function iklan()
    {
        return $this->belongsTo(Iklan::class);
    }

    use HasFactory;
}