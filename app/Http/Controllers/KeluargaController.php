<?php

namespace App\Http\Controllers;

use App\DataTables\KeluargaDataTable;
use App\Models\Keluarga;
use Illuminate\Http\Request;

class KeluargaController extends Controller
{
    public function list(KeluargaDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.keluarga');
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nkk' => 'required|string|min:15|max:17',
            'nik_kepala_keluarga' => 'required|string|min:15|max:17',
            'jumlah_nik' => 'required',

            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        $keluarga = new Keluarga();
        $keluarga->nkk = $request->nkk;
        $keluarga->nik_kepala_keluarga = $request->nik;
        $keluarga->jumlah_nik = $request->jumlah_nik;
        $keluarga->save();

        return redirect()->back()->with('success', 'Keluarga berhasil ditambahkan!');
    }
    public function edit(Keluarga $keluarga)
    {
        return view('keluarga.edit', compact('keluarga'));
    }

    public function update(Request $request, Keluarga $keluarga)
    {
        $request->validate([
            'nkk' => 'required',
            'nik' => 'required',
            'jumlah_nik' => 'required',
        ]);

        $keluarga->update($request->all());

        return redirect()->route('keluarga.manage')
            ->with('success', 'Keluarga berhasil diperbarui.');
    }

    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();

        return redirect()->back()
            ->with('success', 'Keluarga berhasil dihapus.');
    }
}
