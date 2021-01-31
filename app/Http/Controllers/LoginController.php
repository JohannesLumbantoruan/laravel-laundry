<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Hash;
use App\Models\Pelanggan;
use App\Models\Transaksi;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::guard('admin')->check())
        {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function loginAksi(Request $request)
    {
        $messages = [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ];

        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ], $messages);

        $data = [
            'username'  => $request->username,
            'password'  => $request->password,
        ];

        Auth::guard('admin')->attempt($data);

        if (Auth::guard('admin')->check())
        {
            return redirect()->route('dashboard');
        }
        else
        {
            return back()->with('error', 'Username atau password salah');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }

    public function dashboard()
    {
        $transaksi = Transaksi::paginate(5);
        $pelanggan = Pelanggan::count();
        $proses = Transaksi::where('transaksi_status', '=', 0)->count();
        $cuci = Transaksi::where('transaksi_status', '=', 1)->count();
        $selesai = Transaksi::where('transaksi_status', '=', 2)->count();

        return view('dashboard', ['pelanggan' => $pelanggan, 'proses' => $proses, 'cuci' => $cuci, 'selesai' => $selesai, 'transaksi' => $transaksi]);
    }

    public function gantiPassword()
    {
        return view('ganti_password');
    }

    public function gantiPasswordAksi(Request $request)
    {
        $messages = [
            'password_baru.required'    => 'Password baru wajib diisi',
            'password_baru.min'         => 'Password baru minimal 4 karakter',
            'password_baru.max'         => 'Password baru maksimal 20 karakter',
            'password_ulang.required'   => 'Ulangi password',
            'password_ulang.same'       => 'Password tidak sama',
        ];

        $request->validate([
            'password_baru'     => 'required|min:4|max:20',
            'password_ulang'    => 'required|same:password_baru',
        ], $messages);

        $admin = Admin::where('id', '=', Auth::guard('admin')->user()->id)->update(['password' => Hash::make($request->password_ulang)]);

        if ($admin)
        {
            Auth::guard('admin')->logout();

            return redirect()->route('login')->with('success', 'Berhasil mengganti password, silahkan login kembali');
        }
        else
        {
            return back()->with('error', 'Gagal mengganti password, silahkan coba kembali');
        }
    }
}