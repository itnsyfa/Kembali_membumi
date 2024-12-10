<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::latest()->paginate(100);
        return view('barang.list-barang', compact('barangs'));
    }
}