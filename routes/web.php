<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LaundryController;
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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginAksi'])->name('loginAksi');
Route::middleware('auth:admin')->group(function()
{
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/ganti_password', [LoginController::class, 'gantiPassword'])->name('gantiPassword');
    Route::post('/ganti_password_aksi', [LoginController::class, 'gantiPasswordAksi'])->name('gantiPasswordAksi');
    Route::get('/pelanggan', [LaundryController::class, 'pelanggan'])->name('pelanggan');
    Route::get('/pelanggan/cari', [LaundryController::class, 'cariPelanggan'])->name('cariPelanggan');
    Route::get('/pelanggan/tambah', [LaundryController::class, 'tambahPelanggan'])->name('tambahPelanggan');
    Route::post('/pelanggan/tambah_aksi', [LaundryController::class, 'tambahPelangganAksi'])->name('tambahPelangganAksi');
    Route::get('/pelanggan/edit/{id}', [LaundryController::class, 'editPelanggan'])->name('editPelanggan');
    Route::put('/pelanggan/edit_aksi/{id}', [LaundryController::class, 'editPelangganAksi'])->name('editPelangganAksi');
    Route::get('/pelanggan/hapus/{id}', [LaundryController::class, 'hapusPelanggan'])->name('hapusPelanggan');
    Route::get('/harga', [LaundryController::class, 'harga'])->name('harga');
    Route::post('/harga/ubah', [LaundryController::class, 'ubahHarga'])->name('ubahHarga');
    Route::get('/transaksi', [LaundryController::class, 'transaksi'])->name('transaksi');
    Route::get('/transaksi/tambah', [LaundryController::class, 'tambahTransaksi'])->name('tambahTransaksi');
    Route::post('/transaksi/tambah_aksi', [LaundryController::class, 'tambahTransaksiAksi'])->name('tambahTransaksiAksi');
    Route::get('/transaksi/edit/{id}', [LaundryController::class, 'editTransaksi'])->name('editTransaksi');
    Route::put('/transaksi/edit_aksi/{id}', [LaundryController::class, 'editTransaksiAksi'])->name('editTransaksiAksi');
    Route::get('/transaksi/hapus/{id}', [LaundryController::class, 'batalkanTransaksi'])->name('batalkanTransaksi');
    Route::get('/transaksi/invoice/{id}', [LaundryController::class, 'invoice'])->name('invoice');
    Route::get('/transaksi/invoice/pdf/{id}', [LaundryController::class, 'pdfInvoice'])->name('pdfInvoice');
    Route::get('/transaksi/invoice/print/{id}', [LaundryController::class, 'printInvoice'])->name('printInvoice');
    Route::get('/laporan', [LaundryController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/filter', [LaundryController::class, 'laporanAksi'])->name('laporanAksi');
    Route::get('/laporan/print', [LaundryController::class, 'printLaporan'])->name('printLaporan');
    Route::get('/laporan/pdf', [LaundryController::class, 'pdfLaporan'])->name('pdfLaporan');
});