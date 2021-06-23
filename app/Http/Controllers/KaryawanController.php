<?php

namespace App\Http\Controllers;

use App\Models\User;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function viewAddKaryawan()
    {
        return view('karyawan.add');
    }

    public function viewEdit($id)
    {
        $karyawan = User::findOrFail($id);
        return view('karyawan.edit')->with(compact('karyawan'));
    }

    public function viewManage()
    {
        $user = User::all();
        return view('karyawan.manage')->with(compact('user'));
    }

    public function destroy($id)
    {
        if ($id == Auth::user()->id) {
            return back()->with(["error" => "Anda Tidak dapat menghapus akun milik sendiri"]);
        }
        $karyawan = User::findOrFail($id);
        if ($karyawan->delete()) {
            return back()->with(["success" => "Berhasil Menghapus Data Karyawan"]);
        } else {
            return back()->with(["error" => "Gagal Menghapus Data Karyawan"]);
        }
    }
    public function edit(Request $request,$id)
    {
        $rules = [
            'nama' => 'required',
            'nik' => 'required|numeric',
            'email' => 'required|email',
            'kontak' => 'required|numeric',
            'usia' => 'required|numeric',
            'alamat' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);


        $object = User::findOrFail($id);
        $object->name = $request->nama;
        $object->email = $request->email;
        $object->role = $request->role;
        $object->nip = $request->nik;
        $object->usia = $request->usia;
        $object->alamat = $request->alamat;
        $object->kontak = $request->kontak;

        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Menyimpan Perubahan"]);
        } else {
            return back()->with(["error" => "Gagal Menyimpan Perubahan"]);
        }
    }



    public function store(Request $request)
    {

        $rules = [
            'nama' => 'required',
            'nik' => 'required|numeric',
            'email' => 'required|email',
            'kontak' => 'required|numeric',
            'password' => 'required|min:5',
            'usia' => 'required|numeric',
            'alamat' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);


        $object = new User();
        $object->name = $request->nama;
        $object->email = $request->email;
        $object->password = $request->password;
        $object->role = $request->role;
        $object->nip = $request->nik;
        $object->usia = $request->usia;
        $object->alamat = $request->alamat;
        $object->kontak = $request->kontak;

        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Menambah User Baru"]);
        } else {
            return back()->with(["error" => "Gagal Menambah User Baru"]);
        }
    }
}
