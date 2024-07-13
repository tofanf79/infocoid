<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisIklan extends Model
{   
    protected $table = 'jenis_iklan';
    protected $fillable = [
        'jenis'
    ];

    use HasFactory;
}