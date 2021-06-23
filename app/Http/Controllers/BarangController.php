<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Seragam;
use App\Models\Supplier;
use App\Models\User;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function viewAdd()
    {
        return view('barang.add');
    }

    public function viewEdit($id)
    {
        $data = Barang::findOrFail($id);
        return view('barang.edit')->with(compact('data'));
    }

    public function viewMasuk()
    {
        $data = array();
        $barang = Barang::all();
        $supplier = Supplier::all();
        $masuk= BarangMasuk::all();
        return view('barang.masuk')->with(compact('data', 'barang', 'supplier','masuk'));
    }
    public function viewKeluar()
    {
        $data = array();
        $barang = Barang::all();
        $supplier = Supplier::all();
        $keluar= BarangKeluar::all();
        return view('barang.keluar')->with(compact('data', 'barang', 'supplier','keluar'));
    }


    public function storeMasuk(Request $request)
    {
        $object = new BarangMasuk();
        $object->id_barang = $request->barang;
        $object->id_toko = $request->supplier;
        $object->jumlah = $request->jumlah;
        $object->save();

        $barang = Barang::find($request->barang);
        $barang->stock += $request->jumlah;
        $barang->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Menyimpan Transaksi Masuk dan Menambah Stok Barang"]);
        } else {
            return back()->with(["error" => "Gagal Menyimpan Transaksi Masuk dan Menambah Stok Barang"]);
        }
        return view('barang.masuk')->with(compact('data', 'barang', 'supplier'));
    }


    public function cancelKeluar($id)
    {
        $object = BarangKeluar::find($id);
        $barang = Barang::find($object->id_barang);
        $barang->stock += $object->jumlah;
        $barang->save();
        $object->delete();

        if ($object) {
            return back()->with(["success" => "Berhasil Membatalkan Transaksi dan Memulihkan Stok Barang"]);
        } else {
            return back()->with(["error" => "Gagal Membatalkan Transaksi dan Memulihkan Stok Barang"]);
        }
        return view('barang.masuk')->with(compact('data', 'barang', 'supplier'));
    }


    public function cancelMasuk($id)
    {
        $object = BarangKeluar::find($id);
        $barang = Barang::find($object->id_barang);
        $barang->stock -= $object->jumlah;
        $barang->save();
        $object->delete();

        if ($object) {
            return back()->with(["success" => "Berhasil Membatalkan Transaksi dan Memulihkan Stok Barang"]);
        } else {
            return back()->with(["error" => "Gagal Membatalkan Transaksi dan Memulihkan Stok Barang"]);
        }
        return view('barang.masuk')->with(compact('data', 'barang', 'supplier'));
    }


    public function storeKeluar(Request $request)
    {
        $object = new BarangKeluar();
        $object->id_barang = $request->barang;
        $object->jumlah = $request->jumlah;
        

        $barang = Barang::find($request->barang);
        
        if ($barang->stock<$request->jumlah) {
            return back()->with(["error" => "Stock Barang Tidak Cukup"]);
        }
        
        $barang->stock-= $request->jumlah;
        
        
        $object->save();
        $barang->save();


        if ($object) {
            return back()->with(["success" => "Berhasil Menyimpan Transaksi Keluar dan Mengurangi Stok Barang"]);
        } else {
            return back()->with(["error" => "Gagal Menyimpan Transaksi Keluar dan Mengurangi Stok Barang"]);
        }
        return view('barang.masuk')->with(compact('data', 'barang', 'supplier'));
    }


    public function viewManage()
    {
        $data = Barang::where('is_deleted', '=', '0')->get();
        return view('barang.manage')->with(compact('data'));
    }

    public function destroy($id)
    {
        $supplier = Barang::findOrFail($id);
        $supplier->is_deleted = 1;
        if ($supplier->update()) {
            return back()->with(["success" => "Berhasil Menghapus Barang"]);
        } else {
            return back()->with(["error" => "Gagal Menghapus Barang"]);
        }
    }


    public function edit(Request $request, $id)
    {
        $rules = [
            'nama' => 'required',
            'ukuran' => 'required',
            'stok' => 'required|numeric',
            'type' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $object = Barang::findOrFail($id);
        $object->merk = $request->nama;
        $object->size = $request->ukuran;
        $object->stock = $request->stok;
        $object->type = $request->type;

        if ($object->save()) {
            return back()->with(["success" => "Berhasil Mengubah Data Barang"]);
        } else {
            return back()->with(["error" => "Gagal Mengubah Data Barang"]);
        }
    }


    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'ukuran' => 'required',
            'stok' => 'required|numeric',
            'type' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);


        $object = new Barang();
        $object->merk = $request->nama;
        $object->size = $request->ukuran;
        $object->stock = $request->stok;
        $object->type = $request->type;
        $object->save();


        if ($object) {
            return back()->with(["success" => "Berhasil Menambah Data Barang"]);
        } else {
            return back()->with(["error" => "Gagal Menambah Data Barang"]);
        }
    }
}
