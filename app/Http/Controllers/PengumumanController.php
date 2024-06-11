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
            $pengumumanLama = Pengumuman::where('tanggal', '<', $batasTanggal)->get();

            $i = 0;
            foreach ($pengumumanLama as $pengumuman) {
                if ($pengumuman->foto_pengumuman) {
                    $fotoPath = public_path('storage/' . $pengumuman->foto_pengumuman);
                    if (File::exists($fotoPath)) {
                        File::delete($fotoPath);
                    }
                }
                $i++;
            }

            $pengumumanDihapus = Pengumuman::where('tanggal', '<', $batasTanggal)->delete();
            if ($pengumumanDihapus > 0) {
                return redirect()->back()->with('success', $i . ' data pengumuman berhasil dihapus!');
            } else {
                return redirect()->back()->with('info', 'Tidak ada pengumuman yang dapat dihapus.');
            }
        } catch (\Exception $e) {
            Alert::error('Oops!', $e->getMessage());
            return redirect()->back();
        }
    }


    public function index()
    {
        $pengumumans = Cache::remember('globalPengumuman' . request('page', 1), 100, function () {
            return Pengumuman::orderBy('updated_at', 'desc')->paginate(5);
        });
        return view('global.pengumuman')->with('pengumumans', $pengumumans);
    }

    public function list(PengumumanDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.pengumuman');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|min:5|max:49',
            'deskripsi' => 'required',
            'foto_pengumuman' => 'nullable|mimes:png,jpg,jpeg',
        ]);

        try {
            if ($request->hasFile('foto_pengumuman')) {
                $path_foto = 'Foto Pengumuman';
                $foto_pengumuman = $request->file('foto_pengumuman');
                $foto_pengumuman_ext = $foto_pengumuman->getClientOriginalExtension();
                $foto_pengumuman_filename = $validated['judul'] . date('ymdhis') . "." . $foto_pengumuman_ext;
                $path = $foto_pengumuman->storeAs($path_foto, $foto_pengumuman_filename, 'public');
            } else {
                $path = "";
            }

            $tanggalSekarang = \Carbon\Carbon::now();
            $pengumumanData = [
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'],
                'tanggal' => $tanggalSekarang,
                'foto_pengumuman' => $path,
            ];

            Pengumuman::create($pengumumanData);
            return redirect()->back()->with('success', 'Pengumuman berhasil dipublish!');
        } catch (\Exception $e) {
            Alert::error('Oops!', $e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'judul' => 'required|min:5|max:49',
            'deskripsi' => 'required',
            'foto_pengumuman' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);

        try {
            $tanggalSekarang = \Carbon\Carbon::now();
            $pengumuman->update([
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'],
                'tanggal' => $tanggalSekarang,
            ]);

            if ($request->hasFile('foto_pengumuman')) {
                $path_foto = 'Foto Pengumuman';
                $foto_pengumuman = $request->file('foto_pengumuman');
                $foto_pengumuman_ext = $foto_pengumuman->getClientOriginalExtension();
                $foto_pengumuman_filename = $validated['judul'] . date('ymdhis') . "." . $foto_pengumuman_ext;

                if ($pengumuman->foto_pengumuman) {
                    $old_photo_path = storage_path('app/public/' . $pengumuman->foto_pengumuman);
                    if (File::exists($old_photo_path)) {
                        File::delete($old_photo_path);
                    }
                }

                $path = $foto_pengumuman->storeAs($path_foto, $foto_pengumuman_filename, 'public');
                $pengumuman->update(['foto_pengumuman' => $path]);
            }

            return redirect()->route('pengumuman.manage')->with('success', 'Pengumuman berhasil diupdate.');
        } catch (\Exception $e) {
            Alert::error('Oops!', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Pengumuman $pengumuman)
    {
        try {
            if ($pengumuman->foto_pengumuman) {
                $old_photo_path = storage_path('app/public/' . $pengumuman->foto_pengumuman);
                if (File::exists($old_photo_path)) {
                    File::delete($old_photo_path);
                }
            }
            $pengumuman->delete();
            return redirect()->back()
                ->with('success', 'Pengumuman berhasil dihapus.');
        } catch (\Exception $e) {
            Alert::error('Oops!', $e->getMessage());
            return redirect()->back();
        }
    }
}
