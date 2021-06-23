<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/','/login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/karyawan/tambah', 'KaryawanController@viewAddKaryawan');
Route::post('/karyawan/tambah', 'KaryawanController@store');
Route::get('/karyawan/manage', 'KaryawanController@viewManage');
Route::get('/karyawan/{id}/delete', 'KaryawanController@destroy');
Route::get('/karyawan/{id}/edit', 'KaryawanController@viewEdit');
Route::post('/karyawan/{id}/edit', 'KaryawanController@edit');

Route::get('/supplier/tambah', 'SupplierController@viewAdd');
Route::post('supplier/tambah', 'SupplierController@store');
Route::get('/supplier/manage', 'SupplierController@viewManage');
Route::get('/supplier/{id}/delete', 'SupplierController@destroy');
Route::get('/supplier/{id}/edit', 'SupplierController@viewEdit');
Route::post('supplier/{id}/edit', 'SupplierController@edit');


Route::get('/barang/masuk', 'BarangController@viewMasuk');
Route::post('/barang/masuk', 'BarangController@storeMasuk');
Route::get('/barang/keluar', 'BarangController@viewKeluar');
Route::post('/barang/keluar', 'BarangController@storeKeluar');
Route::get('/barang/keluar/{id}/cancel', 'BarangController@cancelKeluar');
Route::get('/barang/masuk/{id}/cancel', 'BarangController@cancelMasuk');


Route::get('/barang/tambah', 'BarangController@viewAdd');
Route::post('barang/tambah', 'BarangController@store');
Route::get('/barang/manage', 'BarangController@viewManage');
Route::get('/barang/{id}/delete', 'BarangController@destroy');
Route::get('/barang/{id}/edit', 'BarangController@viewEdit');
Route::post('barang/{id}/edit', 'BarangController@edit');


Route::get('jadwal-piket', 'PiketController@viewPiket');
Route::post('piket/tambah', 'PiketController@store');
Route::get('/piket/{id}/delete', 'PiketController@destroy');





Route::view('registrasi','auth.registrasi');
Route::post('/login/proc', 'Auth\LoginController@checkLogin');