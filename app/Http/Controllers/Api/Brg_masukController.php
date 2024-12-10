<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use DB;
use App\Models\Brg_masuk;
use App\Http\Resources\BrgMasukResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class Brg_masukController extends Controller
{
    public function index() 
    {
        $brg_masuks = Brg_masuk::join('barangs', 'barangs.id', '=', 'brg_masuks.id_barangs')
                    ->select('brg_masuks.*', 'barangs.harga', 'barangs.nama')
                    ->paginate(5);
        return new BrgMasukResource(true, 'List Data Barang Masuk', $brg_masuks);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_masuk' => 'required', 
            'total_harga' => 'required',
            'tgl_masuk' => 'required',
            'id_barangs' => 'required',
          
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }

        $brg_masuk= Brg_masuk::create([
            'jumlah_masuk' => $request-> jumlah_masuk, 
            'total_harga' => $request-> total_harga,
            'tgl_masuk' => $request-> tgl_masuk,
            'id_barangs' => $request-> id_barangs,
           
        ]);

        return new BrgMasukResource(true, 'Data Berhasil Ditambahkan!', $brg_masuk);
    }

    public function show(Brg_masuk $brg_masuk) {
        return new BrgMasukResource(true, 'Data Barang Masuk ditemukan!', $brg_masuk);
    }
    public function update(Request $request, Brg_masuk $brg_masuk)
    {
        $validator = Validator::make($request->all(), [
            'jumlah_masuk' => 'required', 
            'total_harga' => 'required',
            'tgl_masuk' => 'required',
            'id_barangs' => 'required',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }
        
        if($request->file('image')!=null){
            $image = $request->file('image');
            $image->storeAs('/public/posts', $image->hashName());

            Storage::delete('public/posts/'.$brg_masuk->image);

            $brg_masuk->update([
                'jumlah_masuk' => $request-> jumlah_masuk, 
                'total_harga' => $request-> total_harga,
                'tgl_masuk' => $request-> tgl_masuk,
                'id_barangs' => $request-> id_barangs,
            
                ]);
        }else{
            $brg_masuk->update([
                'jumlah_masuk' => $request-> jumlah_masuk, 
                'total_harga' => $request-> total_harga,
                'tgl_masuk' => $request-> tgl_masuk,
                'id_barangs' => $request-> id_barangs,
            
            ]);
        }
        return new BrgMasukResource(true, 'Data Barang Masuk Berhasil Diubah!', $brg_masuk);
    }
    public function destroy(Brg_masuk $brg_masuk)
    {
        Storage::delete('public/posts/' .$brg_masuk->image);
        $brg_masuk->delete();
        return new BrgMasukResource(true, 'Data Barang Masuk Berhasil Dihapus!', null);
    }
}
