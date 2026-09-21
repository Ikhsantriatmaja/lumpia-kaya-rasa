<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    // =========================
    // TAMPILKAN DATA PELANGGAN / fitur search
    // =========================

        public function index(Request $request)
    {
        $search = $request->search;

        $pelanggan = Pelanggan::where('nama', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->paginate(5);

        return view(
            'pelanggan.index',
            compact('pelanggan', 'search')
        );
    }

    // =========================
    // FORM TAMBAH PELANGGAN
    // =========================

    public function create()
    {
        return view('pelanggan.create');
    }

    // =========================
    // SIMPAN PELANGGAN
    // =========================

    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([

            'nama' => 'required|string|max:100',

            'email' => 'required|email|unique:pelanggan,email',

            'password' => 'required|min:6',

            'alamat' => 'required|string',

            'no_hp' => 'required|numeric',

        ], [

            // PESAN ERROR
            'nama.required' => 'Nama wajib diisi',

            'email.required' => 'Email wajib diisi',

            'email.email' => 'Format email tidak valid',

            'email.unique' => 'Email sudah digunakan',

            'password.required' => 'Password wajib diisi',

            'password.min' => 'Password minimal 6 karakter',

            'alamat.required' => 'Alamat wajib diisi',

            'no_hp.required' => 'No HP wajib diisi',

            'no_hp.numeric' => 'No HP harus berupa angka',

        ]);

        // SIMPAN DATA
        Pelanggan::create([

            'nama' => $request->nama,

            'email' => $request->email,

            'password' => Hash::make($request->password),

            'alamat' => $request->alamat,

            'no_hp' => $request->no_hp,

        ]);

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil ditambahkan');
    }

    // =========================
    // FORM EDIT
    // =========================

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        return view('pelanggan.edit', compact('pelanggan'));
    }

    // =========================
    // UPDATE DATA
    // =========================

    public function update(Request $request, $id)
    {
        // CARI DATA
        $pelanggan = Pelanggan::findOrFail($id);

        // VALIDASI
        $request->validate([

            'nama' => 'required|string|max:100',

            'email' => [
                'required',
                'email',
                Rule::unique('pelanggan')->ignore(
                    $pelanggan->id_pelanggan,
                    'id_pelanggan'
                ),
            ],

            'alamat' => 'required|string',

            'no_hp' => 'required|numeric',

            'password' => 'nullable|min:6',

        ], [

            // PESAN ERROR
            'nama.required' => 'Nama wajib diisi',

            'email.required' => 'Email wajib diisi',

            'email.email' => 'Format email tidak valid',

            'email.unique' => 'Email sudah digunakan',

            'alamat.required' => 'Alamat wajib diisi',

            'no_hp.required' => 'No HP wajib diisi',

            'no_hp.numeric' => 'No HP harus berupa angka',

            'password.min' => 'Password minimal 6 karakter',

        ]);

        // UPDATE DATA
        $pelanggan->nama = $request->nama;

        $pelanggan->email = $request->email;

        $pelanggan->alamat = $request->alamat;

        $pelanggan->no_hp = $request->no_hp;

        // JIKA PASSWORD DIISI
        if ($request->password) {

            $pelanggan->password = Hash::make(
                $request->password
            );

        }

        $pelanggan->save();

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil diupdate');
    }

    // =========================
    // HAPUS DATA
    // =========================

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil dihapus');
    }
}