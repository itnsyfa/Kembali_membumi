<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brg_masuk extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah_masuk',
        'total_harga',
        'tgl_masuk',
        'id_barangs',
    ];
}
