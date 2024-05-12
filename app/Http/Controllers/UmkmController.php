<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Umkm;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\DataTables\UmkmDataTable;
use App\Models\Rw;
use Illuminate\Support\Facades\File;

// use Illuminate\Console\View\Components\Alert;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::where('status_umkm', 'Disetujui')->get();
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
            'nama_umkm' => 'required|string|max:49',
            'foto_umkm' => 'required|mimes:png,jpg,jpeg',
            'deskripsi_umkm' => 'required|string',
            'wa_umkm' => 'required|string|min:10|max:14',
            // 'no_rw' => 'string',
            // 'status_umkm' => 'string',
        ], [
            'nik_pemilik_umkm.required' => 'NIK pemilik UMKM wajib diisi.',
            'nik_pemilik_umkm.string' => 'NIK pemilik UMKM harus berupa teks.',
            'nik_pemilik_umkm.min' => 'NIK pemilik UMKM harus memiliki panjang minimal :min karakter.',
            'nik_pemilik_umkm.max' => 'NIK pemilik UMKM harus memiliki panjang maksimal :max karakter.',
            'nama_umkm.required' => 'Nama UMKM wajib diisi.',
            'nama_umkm.string' => 'Nama UMKM harus berupa teks.',
            'nama_umkm.max' => 'Nama UMKM harus memiliki panjang maksimal :max karakter.',
            'foto_umkm.required' => 'Foto UMKM wajib diunggah.',
            'foto_umkm.mimes' => 'Format foto UMKM harus berupa PNG, JPG, atau JPEG.',
            'deskripsi_umkm.required' => 'Deskripsi UMKM wajib diisi.',
            'deskripsi_umkm.string' => 'Deskripsi UMKM harus berupa teks.',
            'wa_umkm.required' => 'Nomor WhatsApp UMKM wajib diisi.',
            'wa_umkm.string' => 'Nomor WhatsApp UMKM harus berupa teks.',
            'wa_umkm.min' => 'Nomor WhatsApp UMKM harus memiliki panjang minimal :min karakter.',
            'wa_umkm.max' => 'Nomor WhatsApp UMKM harus memiliki panjang maksimal :max karakter.',
        ]);

        $foto_umkm = $request->file('foto_umkm');
        $foto_umkm_ext = $foto_umkm->getClientOriginalExtension();;
        $foto_umkm_filename = $validated['nama_umkm'] . date('ymdhis') . "." . $foto_umkm_ext;
        
        
        try {
            Umkm::create([
                'nama_umkm' => $validated['nama_umkm'],
                'nik_pemilik' => $validated['nik_pemilik_umkm'],
                'wa_umkm' => $validated['wa_umkm'],
                'foto_umkm' => $foto_umkm_filename,
                'deskripsi_umkm' => $validated['deskripsi_umkm'],
                // 'no_rw' => $validated['no_rw'],
                'status_umkm' => 'Baru',
            ]);
            Alert::success('Data UMKM berhasil diajukan!');
            $foto_umkm->move(public_path('Foto UMKM'), $foto_umkm_filename);
            return redirect()->back()->with('warning', 'Data UMKM yang anda ajukan akan tampil pada halaman ini jika sudah melalui proses validasi oleh Ketua RW');
        } catch (\Illuminate\Database\QueryException $e) {
            $no_rw = Rw::all()->pluck('nik_rw');
            Alert::error('NIK Anda Tidak Terdata!', 'Silahkan hubungi RW anda untuk keperluan kelengkapan data kependudukan di Sistem Informasi Rukun Warga ini melalui nomor ' . $no_rw);
            return redirect()->back();
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
            // 'deskripsi_umkm' => 'required',
            'status_umkm' => 'required',
        ], [
            'status_umkm.required' => 'Status UMKM wajib diisi.',
        ]);

        $umkm->update($request->all());

        return redirect()->route('umkm.manage')
            ->with('success', 'Umkm berhasil diperbarui.');
    }

    public function destroy($id)
    {        
        $umkm = Umkm::findOrFail($id);
        File::delete(public_path('Foto UMKM') . '/' . $umkm->foto_umkm);
        $umkm->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}