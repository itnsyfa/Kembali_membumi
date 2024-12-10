<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brg_keluar extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah_keluar',
        'total_harga',
        'tgl_keluar',
        'id_barangs',
        'id_customers',
    ];
}
