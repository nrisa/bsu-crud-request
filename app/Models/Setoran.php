<?php
// app/Models/Setoran.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah',
        'tanggal',
        'setor',
        'jenis',
        'berat',
        'jumlah_setoran',
        'total_poin',
        'total_setoran',
    ];
}

