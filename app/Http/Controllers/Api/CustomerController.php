<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index() 
    {
        $customers = Customer::latest()->paginate(5);
        return new CustomerResource(true, 'List Data Customer', $customers);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_customer' => 'required', 
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }

        $customer= Customer::create([
            'nama_customer' => $request-> nama_customer, 
            'jenis_kelamin' => $request-> jenis_kelamin,
            'alamat' => $request-> alamat,
            'email' => $request-> email,
            'password' => $request-> password,
        ]);

        return new CustomerResource(true, 'Data Berhasil Ditambahkan!', $customer);
    }
    public function show(Customer $customer) {
        return new CustomerResource(true, 'Data Customer ditemukan!', $customer);
    }
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'nama_customer' => 'required', 
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }
        
        if($request->file('gambar')!=null){
            $gambar = $request->file('gambar');
            $gambar->storeAs('/public/storage/gambar', $gambar->hashName());

            Storage::delete('public/storage/gambar/'.$customer->gambar);

            $customer->update([
                'nama_customer' => $request-> nama_customer, 
                'jenis_kelamin' => $request-> jenis_kelamin,
                'alamat' => $request-> alamat,
                'email' => $request-> email,
                'password' => $request-> password,
                ]);
        }else{
            $customer->update([
                'nama_customer' => $request-> nama_customer, 
                'jenis_kelamin' => $request-> jenis_kelamin,
                'alamat' => $request-> alamat,
                'email' => $request-> email,
                'password' => $request-> password,
            ]);
        }
        return new CustomerResource(true, 'Data Customer Berhasil Diubah!', $customer);
    }
    public function destroy(Customer $customer)
    {
        Storage::delete('public/posts/' .$customer->image);
        $customer->delete();
        return new CustomerResource(true, 'Data Customer Berhasil Dihapus!', null);
    }
}
