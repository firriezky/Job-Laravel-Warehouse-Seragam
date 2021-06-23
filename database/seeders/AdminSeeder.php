<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new User();
        $data->name = "Muhammad Firriezky";
        $data->email = "firriezky@gmail.com";
        $data->kontak = "088223738709";
        $data->nip = "1202184264";
        $data->usia = "20";
        $data->alamat = "Bojongsoang";
        $data->password = bcrypt("bojonggede");
        $data->role = "1";
        $data->save();

        $data = new User();
        $data->name = "Admin";
        $data->email = "admin@gmail.com";
        $data->kontak = "088223738710";
        $data->nip = "1202184264";
        $data->usia = "20";
        $data->alamat = "Bojongsoang";
        $data->password = bcrypt("bojonggede");
        $data->role = "1";
        $data->save();
  
    }
}
