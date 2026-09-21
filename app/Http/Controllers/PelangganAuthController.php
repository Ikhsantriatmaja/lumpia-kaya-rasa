<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Hash;

class PelangganAuthController extends Controller
{
    // =========================
    // FORM REGISTER
    // =========================

    public function registerForm()
    {
        return view('pelanggan_auth.register');
    }

    // =========================
    // PROSES REGISTER
    // =========================

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pelanggan,email',
            'password' => 'required|min:6',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        Pelanggan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp
        ]);

        return redirect('/login-pelanggan')
            ->with(
                'success',
                'Registrasi berhasil, silakan login'
            );
    }

    // =========================
    // FORM LOGIN
    // =========================

    public function loginForm()
    {
        return view('pelanggan_auth.login');
    }

    // =========================
    // PROSES LOGIN
    // =========================

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $pelanggan = Pelanggan::where(
            'email',
            $request->email
        )->first();

        if (
            $pelanggan &&
            Hash::check(
                $request->password,
                $pelanggan->password
            )
        ) {

            // Hapus session lama
            $request->session()->invalidate();

            // Generate session baru
            $request->session()->regenerateToken();

            $request->session()->put(
                'pelanggan_id',
                $pelanggan->id_pelanggan
            );

            $request->session()->put(
                'pelanggan_nama',
                $pelanggan->nama
            );

            return redirect()
                ->route('pelanggan.dashboard');
        }

        return back()->with(
            'error',
            'Email atau password salah'
        );
    }

    // =========================
    // DASHBOARD PELANGGAN
    // =========================

    public function dashboard()
    {
        if (!session('pelanggan_id')) {

            return redirect()
                ->route('pelanggan.login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }

        $idPelanggan = session('pelanggan_id');

        $totalPesanan = Pesanan::where(
            'id_pelanggan',
            $idPelanggan
        )->count();

        $pending = Pesanan::where(
            'id_pelanggan',
            $idPelanggan
        )
        ->where(
            'status_pesanan',
            'pending'
        )
        ->count();

        $diproses = Pesanan::where(
            'id_pelanggan',
            $idPelanggan
        )
        ->where(
            'status_pesanan',
            'diproses'
        )
        ->count();

        $selesai = Pesanan::where(
            'id_pelanggan',
            $idPelanggan
        )
        ->where(
            'status_pesanan',
            'selesai'
        )
        ->count();

        $riwayatPesanan = Pesanan::where(
            'id_pelanggan',
            $idPelanggan
        )
        ->latest('id_pesanan')
        ->take(5)
        ->get();

        return view(
            'pelanggan.dashboard',
            compact(
                'totalPesanan',
                'pending',
                'diproses',
                'selesai',
                'riwayatPesanan'
            )
        );
    }

    // =========================
    // LOGOUT
    // =========================

    public function logout(Request $request)
    {
        $request->session()->forget([
            'pelanggan_id',
            'pelanggan_nama'
        ]);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}