<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\DokumenDataTable;
use App\Models\Dokumen;
use RealRashid\SweetAlert\Facades\Alert;

class DokumenController extends Controller
{
    public function list(DokumenDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.dokumen');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jenis_dokumen' => 'required|string|max:50|unique:dokumen,jenis_dokumen',
            'deskripsi' => 'required|string',
        ]);

        try{
            Dokumen::create([
                'jenis_dokumen' => $validated['jenis_dokumen'],
                'deskripsi' => $validated['deskripsi'],
            ]);
            return redirect()->back()->with('success', 'Data Dokumen berhasil ditambahkan!');
        } catch(\Exception $e){
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }

    }

    public function edit(Dokumen $dokumen)
    {
        $dokumen = Dokumen::findOrFail($dokumen->id_dokumen);
        return view('dokumen', compact('dokumen'));
    }

    public function update(Request $request, Dokumen $dokumen)
    {

        // Validasi input
        $validated = $request->validate([
            'jenis_dokumen' => 'required|string|max:50|unique:dokumen,jenis_dokumen,' . $dokumen->id_dokumen . ',id_dokumen',
            'deskripsi' => 'required|string',
        ]);

        // Update dokumen
        try {
            $dokumen->update([
                'jenis_dokumen' => $validated['jenis_dokumen'],
                'deskripsi' => $validated['deskripsi'],
            ]);

            return redirect()->route('dokumen.manage')->with('success', 'Dokumen berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update gagal: ' . $e->getMessage());
        }
    }

    public function destroy(Dokumen $dokumen)
    {
        $dokumen->delete();

        return redirect()->back()
            ->with('success', 'Dokumen berhasil dihapus.');
    }

}
