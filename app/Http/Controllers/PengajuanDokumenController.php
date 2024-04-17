<?php

namespace App\Http\Controllers;

use App\DataTables\PengajuanDokumenDataTable;
use App\Models\PengajuanDokumen;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('global.pengajuandokumen');
    }

    public function list(PengajuanDokumenDataTable $dataTable) {
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
            'id_pengajuandokumen' => 'required',
            'no_rt' => 'required',
            'id_dokumen' => 'required',
            'nik_pengaju' => 'required',
            'nama_pengaju' => 'required',
            // 'no_rw' => 'string',
            // 'status_umkm' => 'string',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        try {
            PengajuanDokumen::create([
                'id_pengajuandokumen' => $validated['id_pengajuandokumen'],
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
            'status_pengajuan' => 'required',
            'catatan' => 'required',
        ]);

        $pengajuandokumen->update($request->all());

        return redirect()->route('pengajuandokumen.manage')
            ->with('success', 'Status Pengajuan Dokumen berhasil diperbarui.');
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