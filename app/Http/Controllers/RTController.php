<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rt;
use App\DataTables\RTDataTable;
use App\Models\Penduduk;
use RealRashid\SweetAlert\Facades\Alert;

class RTController extends Controller
{
    public function index()
    {
        $rts = Rt::all();
        return view('global.rt')->with('rts', $rts);
        // $pengumumans = Pengumuman::all();
        // return view('auth.rw.pengumuman', compact('pengumumans'));
    }

    public function list(RTDataTable $dataTable) {
        return $dataTable->render('auth.rw.pendataan_rt');
    }

    // public function create()
    // {
    //     return view('auth.rw.pengumuman.create');
    // }

    public function show(Rt $rt)
    {
        $rt = Rt::find($rt->no_rt);

        $penduduk = Penduduk::where('nik', $rt->nik_rt)->first();

        $jumlah_keluarga = $rt->keluarga()->count();

        dd($jumlah_keluarga);

        return view('rt.show', compact('rt', 'penduduk', 'jumlah_keluarga'));
    }

    // public function getRTData()
    // {
    //     // Menggunakan eager loading untuk mendapatkan data nama penduduk
    //     $rts = Rt::with('penduduk')->get();

    //     return datatables()->of($rts)
    //         ->addColumn('nama', function (RT $rt) {
    //             return $rt->penduduk ? $rt->penduduk->nama : 'Nama tidak tersedia';
    //         })
    //         ->make(true);
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_rt' => 'required|unique:rt,no_rt',
            'nik_rt' => 'required|min:15|max:17|unique:rt,nik_rt',
            'wa_rt' => 'required|min:11|max:14',
        ], [
            'no_rt.required' => 'Nomor RT wajib diisi.',
            'no_rt.unique' => 'Nomor RT sudah digunakan.',
            'nik_rt.required' => 'NIK RT wajib diisi.',
            'nik_rt.min' => 'NIK RT harus memiliki panjang minimal :min digit.',
            'nik_rt.max' => 'NIK RT harus memiliki panjang maksimal :max digit.',
            'nik_rt.unique' => 'NIK RT sudah digunakan.',
            'wa_rt.required' => 'Nomor WhatsApp RT wajib diisi.',
            'wa_rt.min' => 'Nomor WhatsApp RT harus memiliki panjang minimal :min digit.',
            'wa_rt.max' => 'Nomor WhatsApp RT harus memiliki panjang maksimal :max digit.',
        ]);

        $ketua_rt = Penduduk::all()->where('nik', $validated['nik_rt'])->first();
        // dd($ketua_rt);

        if (!$ketua_rt) {
            return redirect()->back()->with('error', 'NIK Ketua RT yang anda masukkan tidak terdaftar dalam data penduduk!');
        } elseif ($validated['no_rt'] != $ketua_rt->no_rt) {
            return redirect()->back()->with('error', 'Nomor RT yang anda masukkan harus sesuai dengan Nomor RT milik Ketua RT di data penduduk!');
        }

        try{
            Rt::create([
                'no_rt' => $validated['no_rt'],
                'nik_rt' => $validated['nik_rt'],
                'wa_rt' => $validated['wa_rt'],
            ]);
            return redirect()->back()->with('success', 'Data RT berhasil ditambahkan!');
        } catch(\Exception $e){
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit(Rt $rt)
    {
        $rt = Rt::findOrFail($rt->no_rt);
        return view('rt.edit', compact('rt'));
    }

    public function update(Request $request, Rt $rt)
    {
        $validated = $request->validate([
            'no_rt' => 'required|unique:rt,no_rt,'. $rt->no_rt .',no_rt', // (tidak bisa mengubah no_rt as primary key, cek view)
            'nik_rt' => 'required|min:15|max:17|unique:rt,nik_rt,'. $rt->no_rt .',no_rt',
            'wa_rt' => 'required|min:11|max:14',
        ], [
            'no_rt.required' => 'Nomor RT wajib diisi.',
            'no_rt.unique' => 'Nomor RT sudah digunakan.',
            'nik_rt.required' => 'NIK RT wajib diisi.',
            'nik_rt.min' => 'NIK RT harus memiliki panjang minimal :min digit.',
            'nik_rt.max' => 'NIK RT harus memiliki panjang maksimal :max digit.',
            'nik_rt.unique' => 'NIK RT sudah digunakan.',
            'wa_rt.required' => 'Nomor WhatsApp RT wajib diisi.',
            'wa_rt.min' => 'Nomor WhatsApp RT harus memiliki panjang minimal :min digit.',
            'wa_rt.max' => 'Nomor WhatsApp RT harus memiliki panjang maksimal :max digit.',
        ]);

        $ketua_rt = Penduduk::all()->where('nik', $validated['nik_rt'])->first();
        // dd($ketua_rt);

        if (!$ketua_rt) {
            return redirect()->back()->with('error', 'NIK Ketua RT yang anda masukkan tidak terdaftar dalam data penduduk!');
        } elseif ($validated['no_rt'] != $ketua_rt->no_rt) {
            return redirect()->back()->with('error', 'Nomor RT yang anda masukkan harus sesuai dengan Nomor RT milik Ketua RT di data penduduk!');
        }

        try{
            $rt->update($request->all());
            return redirect()->back()->with('success', 'Data RT berhasil diperbarui!');
        } catch(\Exception $e){
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Rt $rt)
    {
        $rt->delete();

        return redirect()->back()
            ->with('success', 'Data RT Berhasil dihapus.');
    }
}