<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index() 
    {
        $users = User::latest()->paginate(5);
        return new UserResource(true, 'List Data Admin', $users);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 442);
        }

        $user= User::create([
            'nama_user' => $request->nama_user,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'username' => $request->username,
                'password'=> $request->password,
        ]);

        return new UserResource(true, 'Data Berhasil Ditambahkan!', $user);
    }
    public function show(User $user) {
        return new UserResource(true, 'Data Admin ditemukan!', $user);
    }
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')){

            $image = $request->file('image');
            $image -> storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts/'.$user->image);

            $user->update([
                'nama_user' => $request->nama_user,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'username' => $request->username,
                'password'=> $request->password,
            ]);
        } else {

            $user->update([
                'nama_user' => $request->nama_user,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'username' => $request->username,
                'password'=> $request->password,
            ]);
        }
        return new UserResource(true, 'Data Admin Berhasil Diubah!', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return new UserResource(true, 'Data Admin Berhasil Dihapus!', null);
    }
}