<?php

namespace App\Http\Controllers;

use App\DataTables\KeluargaDataTable;
use App\Models\Keluarga;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KeluargaController extends Controller
{
    public function list(KeluargaDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.keluarga');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nkk' => 'required|string|min:15|max:17',
            'nik_kepala' => 'required|string|min:15|max:17',
            'jumlah_nik' => 'required',
        ]);

        try{
            Keluarga::create([
                'nkk' => $validated['nkk'],
                'nik_kepala_keluarga' => $validated['nik_kepala'],
                'jumlah_nik' => $validated['jumlah_nik'],
            ]);

            return redirect()->back()->with('success', 'Data Keluarga berhasil ditambahkan!');

        } catch(\Exception $e){
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit(Keluarga $keluarga)
    {
        $keluarga = Keluarga::findOrFail($keluarga->nkk);
        return view('keluarga.edit', compact('keluarga'));
    }

    public function update(Request $request, Keluarga $keluarga)
    {
        $request->validate([
            'nkk' => 'required',
            'nik_kepala' => 'string|min:15|max:17',
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
