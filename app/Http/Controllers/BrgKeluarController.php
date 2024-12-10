<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brg_keluar;
use App\Models\Barang;
use App\Models\Customer;
use DB;

class BrgKeluarController extends Controller
{
    public function index()
    {
        $brg_keluars = Brg_keluar::join('barangs', 'barangs.id', '=', 'brg_keluars.id_barangs')
                    ->join('customers', 'customers.id', '=', 'brg_keluars.id_customers')
                    ->select('brg_keluars.*', 'barangs.*', 'customers.*')
                    ->paginate(100);

        $customers = Customer::all();
        $barangs = Barang::all();
        return view('brg_keluar.list-brg_keluar', compact('customers', 'brg_keluars', 'barangs'));
       

        
    }
}