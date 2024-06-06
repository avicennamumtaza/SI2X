<?php

namespace App\Http\Controllers;

use App\DataTables\KeluargaDataTable;
use App\Models\Keluarga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KeluargaController extends Controller
{
    public function list(KeluargaDataTable $dataTable)
    {
        $niks = Penduduk::pluck('nik');
        return $dataTable->render('auth.rw.keluarga', compact('niks'));
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nkk' => 'required|string|min:15|max:17|unique:keluarga,nkk', // Ganti nama_tabel dengan nama tabel sebenarnya
            'nik_kepala_keluarga' => 'required|string|min:15|max:17|unique:keluarga,nik_kepala_keluarga', // Ganti nama_tabel dengan nama tabel sebenarnya
            // 'no_rt' => 'required|string|max:2',
        ], [
            'nkk.required' => 'Nomor Kartu Keluarga (NKK) wajib diisi.',
            'nkk.string' => 'Nomor Kartu Keluarga (NKK) harus berupa teks.',
            'nkk.min' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang minimal :min digit.',
            'nkk.max' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang maksimal :max digit.',
            'nkk.unique' => 'Nomor Kartu Keluarga (NKK) sudah digunakan.',
            'nik_kepala_keluarga.required' => 'NIK Kepala Keluarga wajib diisi.',
            'nik_kepala_keluarga.string' => 'NIK Kepala Keluarga harus berupa teks.',
            'nik_kepala_keluarga.min' => 'NIK Kepala Keluarga harus memiliki panjang minimal :min digit.',
            'nik_kepala_keluarga.max' => 'NIK Kepala Keluarga harus memiliki panjang maksimal :max digit.',
            'nik_kepala_keluarga.unique' => 'NIK Kepala Keluarga sudah digunakan.',
        ]);

        $kepala_keluarga = Penduduk::all()->where('nik', $validated['nik_kepala_keluarga'])->first();
        // dd($kepala_keluarga->nkk);
        
        if (!$kepala_keluarga) {
            return redirect()->back()->with('error', 'NIK Kepala Keluarga yang anda masukkan tidak terdaftar dalam data penduduk!');
        }
        elseif ($validated['nkk'] != $kepala_keluarga->nkk) {
            return redirect()->back()->with('error', 'Nomor kartu keluarga harus sesuai dengan nomor kepala keluarga!');
        }

        try{
            Keluarga::create([
                'nkk' => $validated['nkk'],
                'nik_kepala_keluarga' => $validated['nik_kepala_keluarga'],
                'no_rt' => $kepala_keluarga->no_rt,
            ]);
            return redirect()->back()->with('success', 'Data keluarga berhasil ditambahkan!');
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
        $validated = $request->validate([
            'nkk' => 'required|string|min:15|max:17', // Ganti nama_tabel dengan nama tabel sebenarnya
            'nik_kepala_keluarga' => 'required|string|min:15|max:17', // Ganti nama_tabel dengan nama tabel sebenarnya
            // 'no_rt' => 'required|string|max:2',
            // 'jumlah_nik' => 'required',
        ], [
            'nkk.required' => 'Nomor Kartu Keluarga (NKK) wajib diisi.',
            'nkk.string' => 'Nomor Kartu Keluarga (NKK) harus berupa teks.',
            'nkk.min' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang minimal :min digit.',
            'nkk.max' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang maksimal :max digit.',
            // 'nkk.unique' => 'Nomor Kartu Keluarga (NKK) sudah digunakan.',
            'nik_kepala_keluarga.required' => 'NIK Kepala Keluarga wajib diisi.',
            'nik_kepala_keluarga.string' => 'NIK Kepala Keluarga harus berupa teks.',
            'nik_kepala_keluarga.min' => 'NIK Kepala Keluarga harus memiliki panjang minimal :min digit.',
            'nik_kepala_keluarga.max' => 'NIK Kepala Keluarga harus memiliki panjang maksimal :max digit.',
            // 'nik_kepala_keluarga.unique' => 'NIK Kepala Keluarga sudah digunakan.',
        ]);

        $kepala_keluarga = Penduduk::all()->where('nik', $validated['nik_kepala_keluarga'])->first();
        // dd($validated);
        
        if (!$kepala_keluarga) {
            return redirect()->back()->with('error', 'NIK Kepala Keluarga yang anda masukkan tidak terdaftar dalam data penduduk!');
        } elseif ($validated['nkk'] != $kepala_keluarga->nkk) {
            return redirect()->back()->with('error', 'Nomor Kartu Keluarga yang anda masukkan harus sesuai dengan Nomor Kartu Keluarga milik Kepala Keluarga di data penduduk!');
        }

        try{
            $keluarga->update([
                'nik_kepala_keluarga' => $validated['nik_kepala_keluarga']
            ]);
            return redirect()->back()->with('success', 'Data keluarga berhasil diperbarui!');
        } catch(\Exception $e){
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }

        return redirect()->route('keluarga.manage')
            ->with('success', 'Keluarga berhasil diperbarui.');
    }

    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();

        return redirect()->back()
            ->with('success', 'Keluarga berhasil dihapus.');
    }

    public function getAnggota($nkk){
        $anggota = Penduduk::where('nkk', $nkk)->get();
        return response()->json($anggota);
    }
}
