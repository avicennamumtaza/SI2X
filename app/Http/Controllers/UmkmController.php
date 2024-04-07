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
        // dd($request->all());
        // Validasi input
        $validated = $request->validate([
            'nik_pemilik_umkm' => 'required|string|min:15|max:17',
            'nama_umkm' => 'required|string|max:50',
            'foto_umkm' => 'required|string',
            'desc_umkm' => 'required|string',
            'wa_umkm' => 'required|string|min:10|max:14',
            'no_rw' => 'string',
            'status_umkm' => 'string',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        // if ($request->fails()) {
        //     return back()->with('errors', $request->messages()->all()[0])->withInput();
        // }

        try {
            // Simpan data UMKM ke dalam database
            // $umkm = new Umkm();
            // $umkm->nama_umkm = $request->nama_umkm;
            // $umkm->nik_pemilik = $request->nik_pemilik;
            // $umkm->foto_umkm = $request->foto_umkm;
            // $umkm->desc_umkm = $request->desc_umkm;
            // $umkm->wa_umkm = $request->wa_umkm;
            // $umkm->no_rw = 6;
            // $umkm->status_umkm = 'Baru';
            // $umkm->save();
            Umkm::create([
                'nama_umkm' => $validated['nama_umkm'],
                'nik_pemilik' => $validated['nik_pemilik_umkm'],
                'wa_umkm' => $validated['wa_umkm'],
                'foto_umkm' => $validated['foto_umkm'],
                'desc_umkm' => $validated['desc_umkm'],
                // 'no_rw' => $validated['no_rw'],
                'status_umkm' => $validated['status_umkm'],
            ]);
            Alert::success('Data UMKM berhasil diajukan!');
            return redirect()->back()->with('warning', 'Data UMKM yang anda ajukan akan tampil pada halaman ini jika sudah melalui proses validasi oleh Ketua RW');
        } catch (\Exception $e) {
            Alert::error('Oops!', $e->getMessage());
            return redirect()->back();
        }
    }
    // public function edit($id)
    // {
    //     // Mengambil data UMKM berdasarkan ID
    //     $umkm = Umkm::findOrFail($id);

    //     // Mengembalikan data UMKM dalam format JSON
    //     return response()->json($umkm);
    // }
    // public function update(Request $request, $id)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'status_umkm' => 'required',
    //         // Tambahkan validasi untuk input lainnya jika diperlukan
    //     ]);

    //     // Mengambil data UMKM berdasarkan ID
    //     $umkm = Umkm::findOrFail($id);

    //     // Memperbarui data UMKM dengan nilai yang diterima dari permintaan
    //     $umkm->update($request->all());

    //     // Redirect atau tampilkan pesan sukses
    //     return redirect()->back()->with('success', 'Data UMKM berhasil diperbarui.');
    // }
    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();
        return redirect()->back()->with('success', 'UMKM berhasil dihapus!');
    }
}