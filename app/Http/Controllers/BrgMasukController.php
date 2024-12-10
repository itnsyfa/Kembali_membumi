<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brg_masuk;
use App\Models\Barang;
use DB;

class BrgMasukController extends Controller{
    
    public function index()
    {
        
        $brg_masuks = Brg_masuk::join('barangs', 'barangs.id', '=', 'brg_masuks.id_barangs')
                    ->select('brg_masuks.*', 'barangs.harga', 'barangs.nama')
                    ->paginate(100);

        $barangs = Barang::all();
        return view('brg_masuk.list-brg_masuk', compact('barangs', 'brg_masuks'));

    }
}