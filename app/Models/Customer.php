<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_customer',
        'jenis_kelamin',
        'alamat',
        'email',
        'password',
    ];
}
