<?php

namespace App\Http\Controllers;

use App\DataTables\PengajuanDokumenDataTable;
use App\Models\Dokumen;
use App\Models\Penduduk;
use App\Models\PengajuanDokumen;
use App\Models\Rt;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        
        // Mengambil hanya kolom 'nik' dari model Penduduk
        $pengajuanDokumens = PengajuanDokumen::all();
        $no_rts = Rt::pluck('no_rt');
        $penduduks = Penduduk::all();
        $dokumens = Dokumen::all();
            
        // Mengirimkan data ke view
        return view('global.pengajuandokumen', compact('pengajuanDokumens','no_rts', 'penduduks', 'dokumens'));
    }
    

    public function list(PengajuanDokumenDataTable $dataTable)
    {
        return $dataTable->render('auth.rt.pengajuandokumen');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $validated = $request->validate([
            // 'id_pengajuandokumen' => 'required', // (tidak bisa mengedit id as primary key, cek view)
            'no_rt' => 'required|max:2',
            'id_dokumen' => 'required',
            'nik_pengaju' => 'required|min:15|max:17',
            'nama_pengaju' => 'required|min:3|max:49',
            // 'no_rw' => 'string',
            // 'status_umkm' => 'string',
        ], [
            'no_rt.required' => 'Nomor RT wajib diisi.',
            'no_rt.max' => 'Nomor RT tidak boleh lebih dari :max karakter.',
            'id_dokumen.required' => 'Jenis Dokumen wajib dipilih.',
            'nik_pengaju.required' => 'NIK Pengaju wajib diisi.',
            'nik_pengaju.min' => 'NIK Pengaju harus memiliki panjang minimal :min karakter.',
            'nik_pengaju.max' => 'NIK Pengaju harus memiliki panjang maksimal :max karakter.',
            'nama_pengaju.required' => 'Nama Pengaju wajib diisi.',
            'nama_pengaju.min' => 'Nama Pengaju harus memiliki panjang minimal :min karakter.',
            'nama_pengaju.max' => 'Nama Pengaju harus memiliki panjang maksimal :max karakter.',
        ]);

        try {
            PengajuanDokumen::create([
                // 'id_pengajuandokumen' => $validated['id_pengajuandokumen'],
                'no_rt' => $validated['no_rt'],
                'id_dokumen' => $validated['id_dokumen'],
                'nik_pengaju' => $validated['nik_pengaju'],
                'nama_pengaju' => $validated['nama_pengaju'],
                'status_pengajuan' => 'Baru',
                'catatan' => '',
            ]);
            Alert::success('Permintaan Dokumen berhasil diajukan!');
            return redirect()->back()->with('warning', 'Status Permintaan Dokumen yang anda ajukan akan tampil pada halaman ini jika sudah melalui proses validasi oleh Ketua RT');
        } catch (\Exception $e) {
            Alert::error('Oops!', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanDokumen $pengajuandokumen)
    {
        $pengajuandokumen = PengajuanDokumen::findOrFail($pengajuandokumen->id_pengajuandokumen);
        return view('pengajuandokumen.edit', compact('pengajuandokumen'));
    }

    public function update(Request $request, PengajuanDokumen $pengajuandokumen)
    {

        $request->validate([
            // 'id_pengajuandokumen' => 'required',
            // 'id_dokumen' => 'required',
            // 'no_rt' => 'required',
            // 'nik_pengaju' => 'required',
            // 'nama_pengaju' => 'required',
            // 'desc_umkm' => 'required',
            'status_pengajuan' => 'required|max:10',
            'catatan' => 'required',
        ], [
            'status_pengajuan.required' => 'Status Pengajuan wajib diisi.',
            'status_pengajuan.max' => 'Status Pengajuan tidak boleh lebih dari :max karakter.',
            'catatan.required' => 'Catatan wajib diisi.',
        ]);

        $pengajuandokumen->update($request->all());

        return redirect()->route('pengajuandokumen.manage')
            ->with('success', 'Status Permintaan Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_pengajuandokumen)
    {
        $pengajuandokumen = PengajuanDokumen::findOrFail($id_pengajuandokumen);
        $pengajuandokumen->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}