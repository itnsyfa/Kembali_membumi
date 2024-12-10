<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Brg_keluar;
use App\Http\Resources\BrgKeluarResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;

class Brg_keluarController extends Controller
{
    public function index() 
    {
        $brg_keluars = Brg_keluar::join('barangs', 'barangs.id', '=', 'brg_keluars.id_barangs')
                    ->join('customers', 'customers.id', '=', 'brg_keluars.id_customers')
                    ->select('brg_keluars.*', 'barangs.harga', 'barangs.nama', 'customers.nama_customer')
                    ->paginate(100);
        return new BrgKeluarResource(true, 'List Data Barang Masuk', $brg_keluars);
    }
    public function store(Request $request, Brg_keluar $brg_keluar)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_keluar' => 'required', 
            'total_harga' => 'required',
            'tgl_keluar' => 'required',
            'id_barangs' => 'required',
            'id_customers' => 'required',
          
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }

        $brg_keluar= Brg_keluar::create([
            'jumlah_keluar' => $request-> jumlah_keluar, 
            'total_harga' => $request-> total_harga,
            'tgl_keluar' => $request-> tgl_keluar,
            'id_barangs' => $request-> id_barangs,
            'id_customers' => $request-> id_customers,
        ]);
        
    return new BrgKeluarResource(true, 'Data Berhasil Ditambahkan!', $brg_keluar);

}
    public function show(Brg_keluar $brg_keluar) {
        return new BrgKeluarResource(true, 'Data Barang Masuk ditemukan!', $brg_keluar);
    }
    public function update(Request $request, Brg_keluar $brg_keluar)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_keluar' => 'required', 
            'total_harga' => 'required',
            'tgl_keluar' => 'required',
            'id_barangs' => 'required',
            'id_customers' => 'required',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }
        
        if($request->file('image')!=null){
            $image = $request->file('image');
            $image->storeAs('/public/posts', $image->hashName());

            Storage::delete('public/posts/'.$brg_keluar->image);

            $brg_keluar->update([
                'jumlah_keluar' => $request-> jumlah_keluar, 
            'total_harga' => $request-> total_harga,
            'tgl_keluar' => $request-> tgl_keluar,
            'id_barangs' => $request-> id_barangs,
            'id_customers' => $request-> id_customers,
            
                ]);
        }else{
            $brg_keluar->update([
                'jumlah_keluar' => $request-> jumlah_keluar, 
            'total_harga' => $request-> total_harga,
            'tgl_keluar' => $request-> tgl_keluar,
             'id_barangs' => $request-> id_barangs,
           'id_customers' => $request-> id_customers,
            
            ]);
        }
        return new BrgKeluarResource(true, 'Data Barang Masuk Berhasil Diubah!', $brg_keluar);
    }
    public function destroy(Brg_keluar $brg_keluar)
    {
        Storage::delete('public/posts/' .$brg_keluar->image);
        $brg_keluar->delete();
        return new BrgKeluarResource(true, 'Data Barang Masuk Berhasil Dihapus!', null);
    }
}