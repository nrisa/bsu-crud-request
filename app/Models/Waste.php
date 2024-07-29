<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    use HasFactory;

    protected $table = 'wastes'; // Specify the table name if it's not the plural of the model name

    protected $fillable = [
        'date',       // Tanggal penginputan
        'category',   // Kategori sampah
        'type',       // Jenis sampah
        'kg',         // Jumlah dalam kg
        'debet',      // Debet
        'kredit',     // Kredit
        'saldo',      // Saldo
    ];
}
