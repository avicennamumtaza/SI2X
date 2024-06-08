<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\File;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function profil()
    {
        $users = auth()->user();
        return view('auth.rw.profil', compact('users'));
    }

    public function updateProfil(Request $request, Users $users)
    {

        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:20',
            //'nik' => 'required|string|min:15|max:17',
            'email' => 'required|string|email|max:50',
            //'foto_profil' => 'nullable|mimes:png,jpg,jpeg',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update user
        try {
            $users->update([
                'username' => $validated['username'],
                //'foto_profil' => $validated['foto_profil'],
                'email' => $validated['email'],
            ]);

            // Hanya update password jika field tersebut diisi
            if (!empty($validated['password'])) {
                $users->password = Hash::make($validated['password']);
                $users->save();
            }

            return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update gagal: ' . $e->getMessage());
        }
    }

    public function changePassword(Request $request, Users $users)
    {
        // Validasi request
        $request->validate([
            'new_password' => 'required|min:8|confirmed', // Konfirmasi password baru
        ]);

        // Setel password baru
        $users->password = Hash::make($request->new_password);
        $users->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profil')->with('success', 'Password berhasil diubah.');
    }

    public function updateFotoProfil(Request $request, Users $users)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:20',
            'foto_profil' => 'required|mimes:png,jpg,jpeg',
        ]);

        $foto_profil = $request->file('foto_profil');

        // Cek apakah ada file foto baru yang diunggah
        if ($foto_profil) {
            // Hapus foto profil yang saat ini tersimpan di server
            try {
            $this->hapusFotoProfil($users);

            // Menyimpan foto baru yang diunggah
            $foto_profil_ext = $foto_profil->getClientOriginalExtension();
            $foto_profil_filename = $validated['username'] . date('ymdhis') . "." . $foto_profil_ext;
            $foto_profil->move(public_path('Foto Users'), $foto_profil_filename);

            
                // Update data pengguna dengan nama file foto baru
                $users->update([
                    'foto_profil' => $foto_profil_filename,
                ]);
                // Redirect kembali ke halaman profil dengan pesan sukses
                return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Update gagal: ' . $e->getMessage());
            }
        }
    }

    private function hapusFotoProfil($users)
    {
        $foto_profil_path = public_path('Foto Users') . '/' . $users->foto_profil;
        if (File::exists($foto_profil_path)) {
            File::delete($foto_profil_path);
        }
    }
}
