<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiket;
use App\Models\User;
use Illuminate\Http\Request;

class PiketController extends Controller
{
    public function viewPiket()
    {
        $karyawan = User::all();
        $piket = JadwalPiket::all()->sortBy('hari');
        return view('piket.manage')->with(compact('karyawan', 'piket'));
    }


    public function destroy($id)
    {
        $piket = JadwalPiket::find($id);
        if ($piket->delete()) {
            return back()->with(["success" => "Berhasil Menghapus Data Piket"]);
        } else {
            return back()->with(["error" => "Gagal Menghapus Data Piket"]);
        }
        return view('piket.manage')->with(compact('karyawan', 'piket'));
    }


    public function store(Request $request)
    {

        $object = new JadwalPiket();

        $karyawan = $request->karyawan;
        $jadwal = $request->hari;

        $findEx = $karyawan . '-' . $jadwal;


        $find = JadwalPiket::where('id_jadwal', '=', $findEx)->count();

        if ($find > 0) {
            return back()->with(["error" => "Karyawan Sudah Memiliki Jadwal Pada Hari Tersebut"]);
        }


        $object->id_karyawan = $request->karyawan;
        $object->jadwal = $request->hari;
        $object->id_jadwal = $findEx;

        if ($object->save()) {
            return back()->with(["success" => "Berhasil Menyimpan Data Piket"]);
        } else {
            return back()->with(["error" => "Gagal Menyimpan Data Piket"]);
        }
    }
}
