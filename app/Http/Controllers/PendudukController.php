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
        $request->validate([
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

        $penduduk = new Penduduk();
        $penduduk->nik = $request->nik;
        $penduduk->nkk = $request->nkk;
        $penduduk->no_rt = $request->no_rt;
        $penduduk->nama = $request->nama;
        $penduduk->tempat_lahir = $request->tempat_lahir;
        $penduduk->tanggal_lahir = $request->tanggal_lahir;
        $penduduk->alamat = $request->alamat;
        $penduduk->jenis_kelamin = $request->jenis_kelamin;
        $penduduk->pekerjaan = $request->pekerjaan;
        $penduduk->gol_darah = $request->gol_darah;
        $penduduk->is_married = $request->is_married;
        $penduduk->is_stranger = $request->is_stranger;
        $penduduk->save();

        return redirect()->back()->with('success', 'Penduduk berhasil ditambahkan!');
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
