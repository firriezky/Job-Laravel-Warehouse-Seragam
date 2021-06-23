<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $append = ['det_barang'];

    function getDetBarangAttribute(){
        return Barang::where('id','=',$this->id_barang)->first();
    }

}
