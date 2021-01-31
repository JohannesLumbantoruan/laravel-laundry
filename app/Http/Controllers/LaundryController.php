<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Harga;
use App\Models\Transaksi;
use App\Models\Pakaian;
use Session;
use PDF;
use Validator;

class LaundryController extends Controller
{
    public function pelanggan()
    {
        $pelanggan = Pelanggan::paginate(10);

        return view('pelanggan.pelanggan', ['pelanggan' => $pelanggan]);
    }

    public function cariPelanggan(Request $requeset)
    {
        $cari = $requeset->cari;
        $pelanggan = Pelanggan::where('pelanggan_nama', 'like', "%".$cari."%")->paginate(10);

        return view('pelanggan.pelanggan', ['pelanggan' => $pelanggan]);
    }

    public function tambahPelanggan()
    {
        return view('pelanggan.tambah_pelanggan');
    }

    public function tambahPelangganAksi(Request $request)
    {
        $messages = [
            'pelanggan_nama.required'   => 'Nama pelanggan wajib diisi',
            'pelanggan_nama.min'        => 'Nama minimal 4 karakter',
            'pelanggan_nama.max'        => 'Nama maksimal 30 karakter',
            'pelanggan_hp.required'     => 'No. HP pelanggan wajib diisi',
            'pelanggan_hp.min'          => 'No. HP minimal 10 angka',
            'pelanggan_hp.max'          => 'No. HP maksimal 12 angka',
            'pelanggan_alamat.required' => 'Alamat pelanggan wajib diisi',
            'pelanggan_alamat.min'      => 'Alamat minimal 5 karakter',
            'pelanggan_alamat.max'      => 'Alamat maksimal 50 karakter',
        ];

        $request->validate([
            'pelanggan_nama'    => 'required|min:4|max:30',
            'pelanggan_hp'      => 'required|min:10|max:12',
            'pelanggan_alamat'  => 'required|min:5|max:50',
        ], $messages);

        $pelanggan = new Pelanggan;
        $pelanggan->pelanggan_nama = $request->pelanggan_nama;
        $pelanggan->pelanggan_hp = $request->pelanggan_hp;
        $pelanggan->pelanggan_alamat = $request->pelanggan_alamat;
        $simpan = $pelanggan->save();

        if ($simpan)
        {
            return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil ditambahkan');
        }
        else
        {
            return back()->with('error', 'Gagal menambahkan pelanggan, silahkan coba kembali');
        }
    }

    public function editPelanggan($id)
    {
        $pelanggan = Pelanggan::find($id);

        return view('pelanggan.edit_pelanggan', ['pelanggan' => $pelanggan]);
    }

    public function editPelangganAksi(Request $request, $id)
    {
        $messages = [
            'pelanggan_nama.required'   => 'Nama pelanggan wajib diisi',
            'pelanggan_nama.min'        => 'Nama minimal 4 karakter',
            'pelanggan_nama.max'        => 'Nama maksimal 30 karakter',
            'pelanggan_hp.required'     => 'No. HP pelanggan wajib diisi',
            'pelanggan_hp.min'          => 'No. HP minimal 10 angka',
            'pelanggan_hp.max'          => 'No. HP maksimal 12 angka',
            'pelanggan_alamat.required' => 'Alamat pelanggan wajib diisi',
            'pelanggan_alamat.min'      => 'Alamat minimal 5 karakter',
            'pelanggan_alamat.max'      => 'Alamat maksimal 50 karakter',
        ];

        $request->validate([
            'pelanggan_nama'    => 'required|min:4|max:30',
            'pelanggan_hp'      => 'required|min:10|max:12',
            'pelanggan_alamat'  => 'required|min:5|max:50',
        ], $messages);

        $pelanggan = Pelanggan::find($id);
        $pelanggan->pelanggan_nama = $request->pelanggan_nama;
        $pelanggan->pelanggan_hp = $request->pelanggan_hp;
        $pelanggan->pelanggan_alamat = $request->pelanggan_alamat;
        $simpan = $pelanggan->save();

        if ($simpan)
        {
            return redirect()->route('pelanggan')->with('success', 'Data pelanggan berhasil diubah');
        }
        else
        {
            return back()->with('error', 'Data pelanggan gagal diubah, silahkan coba kembali');
        }
    }

    public function hapusPelanggan($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil dihapus');
    }

    public function harga()
    {
        $harga = Harga::first();
        Session::put(['harga' => $harga->harga_per_kilo]);

        return view('harga.harga', ['harga' => $harga]);
    }

    public function ubahHarga(Request $request)
    {
        $messages = [
            'harga.required'    => 'Harga wajib diisi',
        ];

        $request->validate([
            'harga' => 'required',
        ], $messages);

        $awal = Session::get('harga');

        $harga = Harga::where('harga_per_kilo', '=', $awal)->update(['harga_per_kilo' => $request->harga]);

        if ($harga)
        {
            return back()->with('success', 'Harga berhasil diubah');
        }
        else
        {
            return back()->with('error', 'Harga gagal diubah, silahkan coba kembali');
        }
    }

    public function transaksi()
    {
        $transaksi = Transaksi::all();

        return view('transaksi.transaksi', ['transaksi' => $transaksi]);
    }

    public function tambahTransaksi()
    {
        $pelanggan = Pelanggan::all();

        return view('transaksi.tambah_transaksi', ['pelanggan' => $pelanggan]);
    }

    public function tambahTransaksiAksi(Request $request)
    {
        $messages = [
            'pelanggan.required'    => 'Pelanggan wajib dipilih',
            'berat.required'        => 'Berat cucian wajib diisi',
            'tgl_selesai.required'  => 'Tanggal cucian selesai wajib diisi',
        ];

        $request->validate([
            'pelanggan'     => 'required',
            'berat'         => 'required',
            'tgl_selesai'   => 'required',
        ], $messages);

        $h = Harga::first();
        $harga = $request->berat * $h->harga_per_kilo;
        $transaksi = new Transaksi;
        $transaksi->transaksi_tgl = date('Y-m-d');
        $transaksi->transaksi_pelanggan = $request->pelanggan;
        $transaksi->transaksi_harga = $harga;
        $transaksi->transaksi_berat =  $request->berat;
        $transaksi->transaksi_tgl_selesai = $request->tgl_selesai;
        $transaksi->transaksi_status = 0;
        $simpan = $transaksi->save();
        $invoice = $transaksi->transaksi_id;

        $pakaian = [];
        for ($x = 0; $x < count($request->jenis_pakaian); $x++)
        {
            if ($request->jenis_pakaian[$x] != "")
            {
                $pakaian[] = [
                    'pakaian_transaksi' => $invoice,
                    'pakaian_jenis'     => $request->jenis_pakaian[$x],
                    'pakaian_jumlah'    => $request->jumlah_pakaian[$x],
                ];
            }
        }
        $simpan2 = Pakaian::insert($pakaian);

        if ($simpan && $simpan2)
        {
            return redirect()->route('transaksi')->with('success', 'Transaksi berhasil ditambahkan');
        }
        else
        {
            return back()->with('error', 'Gagal menambah transaksi, silahkan coba kembali');
        }
    }

    public function editTransaksi($id)
    {
        $transaksi = Transaksi::find($id);
        $pelanggan = Pelanggan::all();
        $pakaian = Pakaian::where('pakaian_transaksi', '=', $transaksi->transaksi_id)->get();

        return view('transaksi.edit_transaksi', ['transaksi' => $transaksi, 'pakaian' => $pakaian, 'pelanggan' => $pelanggan]);
    }

    public function editTransaksiAksi(Request $request, $id)
    {
        $messages = [
            'pelanggan.required'    => 'Pelanggan wajib dipilih',
            'berat.required'        => 'Berat cucian wajib diisi',
            'tgl_selesai.required'  => 'Tanggal cucian selesai wajib diisi',
            'status.required'       => 'Status cucian wajib diisi',
        ];

        $request->validate([
            'pelanggan'     => 'required',
            'berat'         => 'required',
            'tgl_selesai'   => 'required',
            'status'        => 'required',
        ], $messages);

        $h = Harga::first();
        $harga = $request->berat * $h->harga_per_kilo;
        $transaksi = Transaksi::find($id);
        $transaksi->transaksi_tgl = date('Y-m-d');
        $transaksi->transaksi_pelanggan = $request->pelanggan;
        $transaksi->transaksi_harga = $harga;
        $transaksi->transaksi_berat =  $request->berat;
        $transaksi->transaksi_tgl_selesai = $request->tgl_selesai;
        $transaksi->transaksi_status = $request->status;
        $simpan = $transaksi->save();
        $invoice = $transaksi->transaksi_id;

        Pakaian::where('pakaian_transaksi', '=', $invoice)->delete();

        $pakaian = [];
        for ($x = 0; $x < count($request->jenis_pakaian); $x++)
        {
            if ($request->jenis_pakaian[$x] != "")
            {
                $pakaian[] = [
                    'pakaian_transaksi' => $invoice,
                    'pakaian_jenis'     => $request->jenis_pakaian[$x],
                    'pakaian_jumlah'    => $request->jumlah_pakaian[$x],
                ];
            }
        }
        $simpan2 = Pakaian::insert($pakaian);

        if ($simpan && $simpan2)
        {
            return redirect()->route('transaksi')->with('success', 'Berhasil mengupdate transaksi');
        }
        else
        {
            return back()->with('error', 'Gagal mengupdate transaksi, silahkan coba kembali');
        }
    }   

    public function batalkanTransaksi($id)
    {
        $transaksi = Transaksi::find($id);
        $pakaian = Pakaian::where('pakaian_transaksi', '=', $transaksi->transaksi_id);
        $transaksi->delete();
        $pakaian->delete();

        return redirect('transaksi')->with('success', 'Berhasil membatalkan transaksi');
    }

    public function invoice($id)
    {
        $transaksi = Transaksi::find($id);
        $pakaian = Pakaian::where('pakaian_transaksi', '=', $transaksi->transaksi_id)->get();

        return view('transaksi.invoice', ['transaksi' => $transaksi, 'pakaian' => $pakaian]);
    }

    public function pdfInvoice($id)
    {
        set_time_limit(300);
        
        $transaksi = Transaksi::find($id);
        $pakaian = Pakaian::where('pakaian_transaksi', '=', $transaksi->transaksi_id)->get();

        $pdf = PDF::loadView('transaksi.pdf_invoice', ['transaksi' => $transaksi, 'pakaian' => $pakaian]);
        return $pdf->download('invoice.pdf');
    }

    public function printInvoice($id)
    {
        $transaksi = Transaksi::find($id);
        $pakaian = Pakaian::where('pakaian_transaksi', '=', $transaksi->transaksi_id)->get();

        return view('transaksi.print_invoice', ['transaksi' => $transaksi, 'pakaian' => $pakaian]);
    }

    public function laporan()
    {
        $transaksi = Transaksi::all();

        return view('transaksi.laporan', ['transaksi' => $transaksi]);
    }

    public function laporanAksi(Request $request)
    {
        $rules = [
            'tgl_dari'      => 'required',
            'tgl_sampai'    => 'required',
        ];

        Session::put(['dari' => $request->tgl_dari, 'sampai' => $request->tgl_sampai]);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            $transaksi = Transaksi::all();

            return view('transaksi.laporan', ['transaksi' => $transaksi]);
        }
        else
        {
            $transaksi = Transaksi::whereDate('transaksi_tgl', '>=', $request->tgl_dari)->whereDate('transaksi_tgl', '<=', $request->tgl_sampai)->get();

            return view('transaksi.laporan', ['transaksi' => $transaksi]);
        }
    }

    public function printLaporan()
    {
        $dari = Session::get('dari');
        $sampai = Session::get('sampai');
        
        if ($dari == "" || $sampai == "")
        {
            $transaksi = Transaksi::all();

            return view('transaksi.print_laporan', ['dari' => $dari, 'sampai' => $sampai, 'transaksi' => $transaksi]);
        }
        else
        {
            $transaksi = Transaksi::whereDate('transaksi_tgl', '>=', $dari)->whereDate('transaksi_tgl', '<=', $sampai)->get();

            return view('transaksi.print_laporan', ['dari' => $dari, 'sampai' => $sampai, 'transaksi' => $transaksi]);
        }
    }

    public function pdfLaporan()
    {
        set_time_limit(300);

        $dari = Session::get('dari');
        $sampai = Session::get('sampai');
        
        if ($dari == "" || $sampai == "")
        {
            $transaksi = Transaksi::all();

            $pdf = PDF::loadView('transaksi.pdf_laporan', ['dari' => $dari, 'sampai' => $sampai, 'transaksi' => $transaksi]);

            return $pdf->stream();
        }
        else
        {
            $transaksi = Transaksi::whereDate('transaksi_tgl', '>=', $dari)->whereDate('transaksi_tgl', '<=', $sampai)->get();

            $pdf = PDF::loadView('transaksi.pdf_laporan', ['dari' => $dari, 'sampai' => $sampai, 'transaksi' => $transaksi]);
            
            return $pdf->stream();
        }
    }
}
