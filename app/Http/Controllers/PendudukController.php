<?php

namespace App\Http\Controllers;

use App\DataTables\PendudukDataTable;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PendudukController extends Controller
{
    public function list(PendudukDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.penduduk');
    }
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nik' => 'required|string|min:15|max:17',
            'nkk' => 'required|string|min:15|max:17',
            'no_rt' => 'required|string|max:2',
            'nama' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string|max:1',
            'pekerjaan' => 'required|string',
            'gol_darah' => 'required|string|max:2',
            'is_married' => 'required',
            'is_stranger' => 'required',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        try{
            Penduduk::create([
                'nik' => $validated['nik'],
                'nkk' => $validated['nkk'],
                'no_rt' => $validated['no_rt'],
                'nama' => $validated['nama'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'alamat' => $validated['alamat'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'pekerjaan' => $validated['pekerjaan'],
                'gol_darah' => $validated['gol_darah'],
                'is_married' => $validated['is_married'],
                'is_stranger' => $validated['is_stranger'],
            ]);

            Alert::success('Data Penduduk berhasil ditambahkan!');
            return redirect()->back()->with('warning', 'Data penduduk yang anda tambahkan akan tampil di halaman ini');

        } catch(\Exception $e){
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }

    }
    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $request->validate([
            'nik' => 'required',
            'nkk' => 'required',
            'no_rt' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required',
            'gol_darah' => 'required',
            'is_married' => 'required',
            'is_stranger' => 'required',
        ]);

        $penduduk->update($request->all());

        return redirect()->route('penduduk.manage')
            ->with('success', 'Penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->back()
            ->with('success', 'Penduduk berhasil dihapus.');
    }
}
