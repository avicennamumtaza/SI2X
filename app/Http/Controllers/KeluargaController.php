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
        // Validasi input
        $validated = $request->validate([
            'nkk' => 'required|string|min:15|max:17|unique:keluarga,nkk', // Ganti nama_tabel dengan nama tabel sebenarnya
            'nik_kepala' => 'required|string|min:15|max:17|unique:keluarga,nik_kepala_keluarga', // Ganti nama_tabel dengan nama tabel sebenarnya
            'jumlah_nik' => 'required',
        ], [
            'nkk.required' => 'Nomor Kartu Keluarga (NKK) wajib diisi.',
            'nkk.string' => 'Nomor Kartu Keluarga (NKK) harus berupa teks.',
            'nkk.min' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang minimal :min digit.',
            'nkk.max' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang maksimal :max digit.',
            'nkk.unique' => 'Nomor Kartu Keluarga (NKK) sudah digunakan.',
            'nik_kepala.required' => 'NIK Kepala Keluarga wajib diisi.',
            'nik_kepala.string' => 'NIK Kepala Keluarga harus berupa teks.',
            'nik_kepala.min' => 'NIK Kepala Keluarga harus memiliki panjang minimal :min digit.',
            'nik_kepala.max' => 'NIK Kepala Keluarga harus memiliki panjang maksimal :max digit.',
            'nik_kepala.unique' => 'NIK Kepala Keluarga sudah digunakan.',
            'jumlah_nik.required' => 'Jumlah NIK wajib diisi.',
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
        // $keluarga = Keluarga::findOrFail($keluarga->nkk);
        return view('keluarga.edit', compact('keluarga'));
    }

    public function update(Request $request, Keluarga $keluarga)
    {
        $request->validate([
            // 'nkk' => 'required|string|min:15|max:17|unique:keluarga,nkk', // Ganti nama_tabel dengan nama tabel sebenarnya
            'nik_kepala' => 'required|string|min:15|max:17', // Ganti nama_tabel dengan nama tabel sebenarnya
            'jumlah_nik' => 'required',
        ], [
            // 'nkk.required' => 'Nomor Kartu Keluarga (NKK) wajib diisi.',
            // 'nkk.string' => 'Nomor Kartu Keluarga (NKK) harus berupa teks.',
            // 'nkk.min' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang minimal :min digit.',
            // 'nkk.max' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang maksimal :max digit.',
            // 'nkk.unique' => 'Nomor Kartu Keluarga (NKK) sudah digunakan.',
            'nik_kepala.required' => 'NIK Kepala Keluarga wajib diisi.',
            'nik_kepala.string' => 'NIK Kepala Keluarga harus berupa teks.',
            'nik_kepala.min' => 'NIK Kepala Keluarga harus memiliki panjang minimal :min digit.',
            'nik_kepala.max' => 'NIK Kepala Keluarga harus memiliki panjang maksimal :max digit.',
            // 'nik_kepala.unique' => 'NIK Kepala Keluarga sudah digunakan.',
            'jumlah_nik.required' => 'Jumlah NIK wajib diisi.',
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
