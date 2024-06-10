<?php

namespace App\Http\Controllers;

use App\DataTables\PengumumanDataTable;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PengumumanController extends Controller
{
    public function hapusPengumumanLama(Request $request)
    {
        $validated = $request->validate([
            'hari' => 'required|integer|min:1',
        ]);

        $hari = $validated['hari'];
        $batasTanggal = \Carbon\Carbon::now()->subDays($hari)->format('Y-m-d');

        try {
            $pengumumanDihapus = Pengumuman::where('tanggal', '<', $batasTanggal)->delete();

            if ($pengumumanDihapus > 0) {
                return redirect()->back()->with('success', 'Pengumuman lama berhasil dihapus!');
            } else {
                return redirect()->back()->with('info', 'Tidak ada pengumuman yang perlu dihapus.');
            }
        } catch (\Exception $e) {
            Alert::error('Oops!', $e->getMessage());
            return redirect()->back();
        }
    }

    public function index()
    {
        $pengumumans =
            // Cache::remember('globalPengumuman' . request('page', 1), 600, function () {
            // return
            Pengumuman::orderBy('updated_at', 'desc')->paginate(5);
        // });
        return view('global.pengumuman')->with('pengumumans', $pengumumans);
        // $pengumumans = Pengumuman::all();
        // return view('auth.rw.pengumuman', compact('pengumumans'));
    }

    public function list(PengumumanDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.pengumuman');
    }

    // public function create()
    // {
    //     return view('auth.rw.pengumuman.create');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|min:5|max:49',
            'deskripsi' => 'required',
            'tanggal_pengumuman' => 'required|date',
            'foto_pengumuman' => 'nullable|mimes:png,jpg,jpeg',
        ]);

        try {
            if (isset($validated['foto_pengumuman'])) {
                $path_foto = 'Foto Pengumuman';
                $foto_pengumuman = $request->file('foto_pengumuman');
                $foto_pengumuman_ext = $foto_pengumuman->getClientOriginalExtension();
                $foto_pengumuman_filename = $validated['judul'] . date('ymdhis') . "." . $foto_pengumuman_ext;
                $path = $foto_pengumuman->storeAs($path_foto, $foto_pengumuman_filename, 'public');
                // $pengumumanData['foto_pengumuman'] = $path;
            } else {
                $path = "";
            }
            $pengumumanData = [
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'],
                'tanggal' => $validated['tanggal_pengumuman'],
                'foto_pengumuman' => $path,
            ];

            Pengumuman::create($pengumumanData);
            return redirect()->back()->with('success', 'Pengumuman berhasil dipublish!');
        } catch (\Exception $e) {
            Alert::error('Oops!', $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit(Pengumuman $pengumuman)
    {
        // $pengumuman = Pengumuman::findOrFail($pengumuman->id_pengumuman);
        return view('pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'judul' => 'required|min:5|max:49',
            'deskripsi' => 'required',
            'tanggal_pengumuman' => 'required|date',
            'foto_pengumuman' => 'image|mimes:jpeg,jpg,png',
        ]);

        Pengumuman::find($pengumuman->id_pengumuman)->update([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal' => $validated['tanggal_pengumuman'],
        ]);

        if ($request->hasFile('foto_pengumuman')) {
            $foto_pengumuman = $request->file('foto_pengumuman');
            $foto_pengumuman_ext = $foto_pengumuman->getClientOriginalExtension();
            $foto_pengumuman_filename = $validated['judul'] . date('ymdhis') . "." . $foto_pengumuman_ext;
            if ($pengumuman->foto_pengumuman) {
                File::delete(public_path('Foto Pengumuman') . '/' . $pengumuman->foto_pengumuman);
            }
            $foto_pengumuman->storeAs('foto_pengumuman', $foto_pengumuman_filename, 'public');
            $pengumuman->update(['foto_pengumuman' => $foto_pengumuman_filename]);
        }

        return redirect()->route('pengumuman.manage')->with('success', 'Pengumuman berhasil dipublish.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        // Pengumuman::find($pengumuman->id_pengumuman)->delete();
        File::delete(public_path('Foto Pengumuman') . '/' . $pengumuman->foto_pengumuman);
        $pengumuman->delete();
        return redirect()->back()
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
