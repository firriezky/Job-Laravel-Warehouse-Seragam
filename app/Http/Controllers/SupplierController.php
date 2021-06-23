<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function viewAdd()
    {
        return view('supplier.add');
    }

    public function viewEdit($id)
    {
        $data = Supplier::findOrFail($id);
        return view('supplier.edit')->with(compact('data'));
    }

    public function viewManage()
    {
        $supplier = Supplier::where('is_deleted','=','0')->get();
        return view('supplier.manage')->with(compact('supplier'));
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->is_deleted=1;
        if ($supplier->update()) {
            return back()->with(["success" => "Berhasil Menghapus Data Supplier"]);
        } else {
            return back()->with(["error" => "Gagal Menghapus Data Supplier"]);
        }
    }
    public function edit(Request $request,$id)
    {
        $rules = [
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'alamat' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);


        $object = Supplier::findOrFail($id);
        $object->nama_toko = $request->nama;
        $object->alamat = $request->alamat;
        $object->kontak = $request->kontak;
        $object->save();


        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Data Supplier"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data Supplier"]);
        }
    }


    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'kontak' => 'required|numeric',
            'alamat' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);


        $object = new Supplier();
        $object->nama_toko = $request->nama;
        $object->alamat = $request->alamat;
        $object->kontak = $request->kontak;
        $object->save();


        if ($object) {
            return back()->with(["success" => "Berhasil Menambah Supplier"]);
        } else {
            return back()->with(["error" => "Gagal Menambah Supplier Baru"]);
        }
    }
}
