<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Form login
    public function loginForm()
    {
        return view('auth.login');
    }

    // Proses login
        public function login(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        // Email tidak ditemukan
        if (!$admin) {

            return back()->with(
                'error',
                'Email tidak ditemukan'
            );
        }

        // Password salah
        if (!Hash::check($request->password, $admin->password)) {

            return back()->with(
                'error',
                'Password salah'
            );
        }

        session([
            'admin_id' => $admin->id_admin,
            'admin_nama' => $admin->nama
        ]);

        return redirect()->route('admin.dashboard');
    }

    // Logout
    public function logout()
    {
        session()->forget([
            'admin_id',
            'admin_nama'
        ]);

        return redirect('/login');
    }
}