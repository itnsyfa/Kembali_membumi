<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Http\Resources\BarangResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index() 
    {
        $barangs = Barang::latest()->paginate(100);
        return new BarangResource(true, 'List Data Barang', $barangs);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori'=> 'required',
            'stok'=> 'required',
            'deskripsi' => 'required', 
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }

        $gambar = $request->file('gambar');
        $gambar->storeAs('/public/gambar', $gambar->hashName());

        $barang = Barang::create([
            'nama' => $request-> nama,
            'kategori'=> $request-> kategori,
            'stok'=> $request-> stok,
            'deskripsi' => $request-> deskripsi,
            'gambar' => $gambar->hashName(),
            'harga'=> $request-> harga, 
        ]);
        
        return new BarangResource(true, 'Data Berhasil Ditambahkan!', $barang);
    }
    public function show(Barang $barang) {
        return new BarangResource(true, 'Data barang ditemukan!', $barang);
    }
    public function update(Request $request, Barang $barang)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori'=> 'required',
            'stok'=> 'required',
            'deskripsi' => 'required', 
            'harga'=> 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }
        
        if($request->file('gambar')!=null){
            $gambar = $request->file('gambar');
            $gambar->storeAs('storage/storage/gambar/', $gambar->hashName());

            Storage::delete('storage/storage/gambar/'.$barang->gambar);

            $barang->update([
                'nama' => $request-> nama,
                'kategori'=> $request-> kategori,
                'stok'=> $request-> stok,
                'deskripsi' => $request-> deskripsi,
                'harga'=> $request-> harga,    
                ]);
        }else{
            $barang->update([
                'nama' => $request-> nama,
                'kategori'=> $request-> kategori,
                'stok'=> $request-> stok,
                'deskripsi' => $request-> deskripsi,
                'harga'=> $request-> harga,    
                ]);
        }
        return new BarangResource(true, 'Data Barang Berhasil Diubah!', $barang);
    }
    //public function destroy(Barang $barang)
    //{
        //Storage::delete('public/storage/gambar/' .$barang->gambar);
       // $barang->delete();
        //return new BarangResource(true, 'Data Barang Berhasil Dihapus!', null);
    //}

}
