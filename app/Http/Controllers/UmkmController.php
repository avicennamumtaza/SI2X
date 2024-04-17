<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Umkm;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\UmkmDataTable;
// use Illuminate\Console\View\Components\Alert;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::where('status_umkm', 'Diterima')->get();
        $nik_penduduks = Penduduk::select('nik')->get();
        return view('global.umkm')->with('umkms', $umkms)->with('nik_penduduks', $nik_penduduks);
        // return view('global.umkm');
    }
    // Fungsi tambahan untuk menampilkan seluruh data UMKM
    public function list(UmkmDataTable $dataTable)
    {
        // $umkms = Umkm::all();
        // return view('auth.rw.umkm')->with('umkms', $umkms);
        return $dataTable->render('auth.rw.umkm');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik_pemilik_umkm' => 'required|string|min:15|max:17',
            'nama_umkm' => 'required|string|max:50',
            'foto_umkm' => 'required|string',
            'desc_umkm' => 'required|string',
            'wa_umkm' => 'required|string|min:10|max:14',
            // 'no_rw' => 'string',
            // 'status_umkm' => 'string',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        try {
            Umkm::create([
                'nama_umkm' => $validated['nama_umkm'],
                'nik_pemilik' => $validated['nik_pemilik_umkm'],
                'wa_umkm' => $validated['wa_umkm'],
                'foto_umkm' => $validated['foto_umkm'],
                'desc_umkm' => $validated['desc_umkm'],
                // 'no_rw' => $validated['no_rw'],
                'status_umkm' => 'Baru',
            ]);
            Alert::success('Data UMKM berhasil diajukan!');
            return redirect()->back()->with('warning', 'Data UMKM yang anda ajukan akan tampil pada halaman ini jika sudah melalui proses validasi oleh Ketua RW');
        } catch (\Exception $e) {
            Alert::error('Oops!', $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit(Umkm $umkm)
    {
        $umkm = Umkm::findOrFail($umkm->nik);
        return view('umkm.edit', compact('umkm'));
    }
    public function update(Request $request, Umkm $umkm)
    {

        $request->validate([
            // 'id_umkm' => 'required',
            // 'nik_pemilik' => 'required',
            // 'nama_umkm' => 'required',
            // 'wa_umkm' => 'required',
            // 'foto_umkm' => 'required',
            // 'desc_umkm' => 'required',
            'status_umkm' => 'required',
        ]);

        $umkm->update($request->all());

        return redirect()->route('umkm.manage')
            ->with('success', 'Umkm berhasil diperbarui.');
    }
    
    public function delete($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }    
}
