<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodePembayaran;
use Illuminate\Support\Facades\Storage;

class MetodePembayaranController extends Controller
{
    // =========================
    // LIST DATA
    // =========================

    public function index()
    {
        $metode = MetodePembayaran::all();

        return view(
            'metode_pembayaran.index',
            compact('metode')
        );
    }

    // =========================
    // FORM TAMBAH
    // =========================

    public function create()
    {
        return view('metode_pembayaran.create');
    }

    // =========================
    // SIMPAN
    // =========================

    public function store(Request $request)
    {
        $request->validate([

            'nama_metode' => 'required',

            'qris' => 'required|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $gambarQris = null;

        if ($request->hasFile('qris')) {

            $gambarQris = $request
                ->file('qris')
                ->store('qris', 'public');

        }

        MetodePembayaran::create([

            'nama_metode' => $request->nama_metode,

            'qris' => $gambarQris

        ]);

        return redirect()
            ->route('metode-pembayaran.index')
            ->with(
                'success',
                'QRIS berhasil ditambahkan.'
            );
    }

    // =========================
    // FORM EDIT
    // =========================

    public function edit($id)
    {
        $metode = MetodePembayaran::findOrFail($id);

        return view(
            'metode_pembayaran.edit',
            compact('metode')
        );
    }

    // =========================
    // UPDATE
    // =========================

    public function update(Request $request, $id)
    {
        $metode = MetodePembayaran::findOrFail($id);

        $request->validate([

            'nama_metode' => 'required'

        ]);

        if ($request->hasFile('qris')) {

            if (
                $metode->qris &&
                Storage::disk('public')->exists($metode->qris)
            ) {

                Storage::disk('public')->delete($metode->qris);

            }

            $metode->qris = $request
                ->file('qris')
                ->store('qris', 'public');

        }

        $metode->nama_metode = $request->nama_metode;

        $metode->save();

        return redirect()
            ->route('metode-pembayaran.index')
            ->with(
                'success',
                'QRIS berhasil diperbarui.'
            );
    }

    // =========================
    // HAPUS
    // =========================

    public function destroy($id)
    {
        $metode = MetodePembayaran::findOrFail($id);

        if (
            $metode->qris &&
            Storage::disk('public')->exists($metode->qris)
        ) {

            Storage::disk('public')->delete($metode->qris);

        }

        $metode->delete();

        return redirect()
            ->route('metode-pembayaran.index')
            ->with(
                'success',
                'Metode pembayaran berhasil dihapus.'
            );
    }
}